<?php

namespace App\Http\Workflows;

use App\Models\WorkflowRequest;
use App\Traits\StringDates;
use Auth;
use Exception as DefaultException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\Exception\Exception;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;
use Storage;
use Str;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class PdfHelper
{
    use StringDates;

    private WorkflowRequest $workflowRequest;
    private $fields, $qr_name, $process;
    private string $folder, $pdfName;

    public function __construct(WorkflowRequest $workflowRequest, $fields, $process)
    {
        $this->workflowRequest = $workflowRequest;
        $this->fields =  $fields;
        $this->process = $process;
        $this->folder = 'generated-documents/';
        $this->qr_name = $this->folder.'qr_'.$this->workflowRequest->key.'.png';
        $this->pdfName =  $this->process == 1 ? $this->folder.'dictamen_'.$this->workflowRequest->key.'.pdf'
            : $this->folder.'resolution_'.$this->workflowRequest->key.'.pdf';
        if (!Storage::exists($this->folder)) {
            Storage::makeDirectory($this->folder);
        }
    }

    public function generateAuthorizationPdf(): ?string
    {
        try {
            $this->fields['string_date'] = $this->stringDate(date('d'), date('m'), date('Y'));
            $this->fields['year'] = date('Y');
            $requirements_date = $this->workflowRequest->stateStages[0]->updated_at ?? date('Y-m-d');
            $day = $requirements_date->format('d');
            $mount = $requirements_date->format('m');
            $year = $requirements_date->format('Y');
            $this->fields['requirements_date'] = mb_strtolower($this->stringDate($day, $mount, $year), 'UTF-8');
            $this->fields['qr_code'] = $this->getQrImage();
            $this->fields['id'] = $this->workflowRequest->id;
            $this->fields['content_name'] = $this->templateName();

            PDF::loadView('documents.authorization-templates.base-template', [
                'fields' => $this->fields
            ])->setPaper('A4')->save($this->pdfName, 'public')->stream();

            return $this->pdfName;
        } catch (DefaultException) {
            return null;
        }
    }

    public function generateDictamenPdf(): string|null
    {
        try {
            $docName = $this->folder . Str::random(20) . '.docx';

            Settings::setPdfRendererPath(base_path('vendor/dompdf/dompdf'));
            Settings::setPdfRendererName('DomPDF');

            $templateName =  $this->templateName();
            $templatePath = resource_path('templates/'.$templateName);

            $template = new TemplateProcessor($templatePath);

            $this->fields['string_date'] = $this->stringDate(date('d'), date('m'), date('Y'));
            $this->fields['year'] = date('Y');
            $requirements_date = $this->workflowRequest->stateStages[0]->updated_at ?? date('Y-m-d');
            $day = $requirements_date->format('d');
            $mount = $requirements_date->format('m');
            $year = $requirements_date->format('Y');
            $this->fields['requirements_date'] = mb_strtolower($this->stringDate($day, $mount, $year), 'UTF-8');

            $data_fields = array_map(function($value) { return str_replace('&', '&amp;', $value); }, $this->fields);
            // Enviar valores a la plantilla
            $template->setValues($data_fields);
            $template->setImageValue('signature', public_path('assets/img/firma-dictamen.png'));
            $template->setImageValue('seal', public_path('assets/img/sello-dictamen.png'));

            $saveDocPath = Storage::path($docName);
            $template->saveAs($saveDocPath);

            $content = IOFactory::load($saveDocPath);
            $savePdfPath = Storage::path($this->pdfName);

            if (file_exists($savePdfPath)) {
                unlink($savePdfPath);
            }

            $PDFWriter = IOFactory::createWriter($content, 'PDF');
            $PDFWriter->save($savePdfPath);

            if (file_exists($saveDocPath)) {
                unlink($saveDocPath);
            }

            return $this->pdfName;
        } catch (Exception|CopyFileException|CreateTemporaryFileException) {
            return null;
        }
    }

    public function singPdf(string $filePath, string $pin): array
    {
        /*$url = env('SIGNBOX_URL');
        $sessionId = env('SESSION_ID');
        $env = env('SIGNBOX_ENV');*/
		
		$url = "https://signboxsync-v2.movil-max.com/api/syncSign";
        $sessionId = "cd2ecabf-1f82-4ef1-bdf9-a6a8e9fa4fb8";
        $env = "prod";

        if (!$url || !$sessionId || !$env) {
            return [
                'result' => false,
                'message' => 'No se ha configurado el servicio de firma digital en las variables de entorno.',
            ];
        }

        if (!Storage::exists($filePath)) {
            return [
                'result' => false,
                'message' => 'El archivo a firmar no existe.',
            ];
        }

        $fileContents = base64_encode(file_get_contents(Storage::path($filePath)));

        $user = Auth::user();

        if (!$user || !$user->signature_user || !$user->signature_password || !$user->signature_image || !$pin) {
            return [
                'result' => false,
                'message' => 'El usuario no tiene configurada la firma digital.',
            ];
        }

        $imageContents = base64_encode(file_get_contents(Storage::path($user->signature_image)));

        $params = [
            "username" => $user->signature_user,
            "password" => $user->signature_password,
            "pin" => $pin,
            "env" => $env,
            "format" => "pades",
            "level" => "BES",
            "npage" => 0,
            "img" => $imageContents,
            "img_size" => "200,200",
            "position" => "213,115,403,175",
            "filename" => $filePath,
            "file" => $fileContents,
            "paragraph_format" => "[{\"font\":[\"Universal-Italic\",12],\"align\": \"right\",\"data_format\": {\"timezone\": \"America/Guatemala\",\"strtime\": \"%d/%m/%Y %H:%M:%S%z\"},\"format\": [\"Firmado por:\",\"$(CN)s\",\"DPI: $(serialNumber)s\",\"Lugar: $(C)s\",\"Fecha: $(date)s\"]}]",
        ];

        try {
            $client = new Client();

            $response = $client->post($url, [
                'json' => $params,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'session-id' => $sessionId,
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $body = $response->getBody();
                $json = json_decode($body, true);

                if ($json['status'] === 'DONE') {
                    unlink(Storage::path($this->qr_name));
                    return [
                        'result' => true,
                        'message' => 'El archivo ha sido firmado correctamente.',
                        'file' => $json['file'],
                    ];
                }
            }

        } catch (GuzzleException) {

        }

        return [
            'result' => false,
            'message' => 'No se ha podido firmar el archivo. Validar que las credenciales de firma digital sean correctas.',
        ];
    }

    public function getQrImage(): string
    {
        $qrCode = new QrCode(Storage::url($this->pdfName));
        $qrCode->setSize(90);
        $qrImage = (new PngWriter())->write($qrCode);
        $qrContents = $qrImage->getString();
        Storage::put($this->qr_name, $qrContents);
        return Storage::path($this->qr_name);
    }
    public function templateName(): string
    {
        $type = $this->workflowRequest->process_type;
        $workflow_type = $this->workflowRequest->workflow->type;

        if ($this->process == 1) {
            // DICTAMEN
            if ($type == 1) {
                $template = match ($workflow_type) {
                    1 => 'nuevo-individual-dictamen.docx',
                    2 => 'ampliacion-individual-dictamen.docx',
                    3 => 'renovacion-individual-dictamen.docx',
                    7 => 'cambio-nombre-individual-dictamen.docx',
                    default => ''
                };
            } elseif ($type == 2) {
                $template = match ($workflow_type) {
                    1 => 'nuevo-juridico-dictamen.docx',
                    2 => 'ampliacion-juridico-dictamen.docx',
                    3 => 'renovacion-juridico-dictamen.docx',
                    7 => 'cambio-nombre-juridico-dictamen.docx',
                    default => ''
                };
            } else {
                $template = match ($workflow_type) {
                    4 => 'nuevo-individual-dictamen.docx',
                    5 => 'cancelacion-dictamen.docx',
                    6 => 'cambio-razon-dictamen.docx',
                    default => ''
                };
            }
        } else {
            // AUTORIZACIÓN O RESOLUCIÓN
            if ($type == 1) {
                $template = match ($workflow_type) {
                    1 => 'nuevo-individual',
                    2 => 'ampliacion-individual',
                    3 => 'renovacion-individual',
                    7 => 'cambio-nombre-individual',
                    default => ''
                };
            } elseif ($type == 2) {
                $template = match ($workflow_type) {
                    1 => 'nuevo-juridico',
                    2 => 'ampliacion-juridico',
                    3 => 'renovacion-juridico',
                    7 => 'cambio-nombre-juridico',
                    default => ''
                };
            } else {
                $template = match ($workflow_type) {
                    4 => 'compra-venta',
                    5 => 'cancelacion',
                    6 => 'cambio-razon',
                    default => ''
                };
            }
        }
        return $template;
    }
}
