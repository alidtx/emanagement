<?php

namespace App\Console\Commands;

use App\Models\Certificate;
use App\Models\CertificateSettings;
use App\Models\UserCourseEnroll;
use App\Services\FileUploadService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use PDF;

class GenerateCertificate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:certificate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate user certificate in PDF, store in database, and send email';

    /**
     * Execute the console command.
     */

    public function handle()
    {

        $userCourses = UserCourseEnroll::with("course", "user")->get();
        $certificate_signature = CertificateSettings::find("certificate_signature");

        foreach ($userCourses as $item) {

            $data = [
                "studentName" => $item->user->name,
                "courseName"  => $item->course->title,
                'verificationLink' => 'https://example.com/verification',
                "certificate_signature"  => $certificate_signature,
            ];

            $pdf = PDF::loadView('certificate.certificate-template-02', $data);

            $pdf->setPaper('letter', 'landscape');

            $pdf->output();

            $fileDir = 'public/pdf_certificates';
            $uniqueKey = bin2hex(random_bytes(16)); // 16 bytes = 128 bits

            $fileName = $uniqueKey . '.pdf';

            // Store the PDF in the storage disk
            Storage::put($fileDir . '/' . $fileName, $pdf->output(), 'public');

            Certificate::create([
                'user_id' => $item->user_id,
                'file_path' => "pdf_certificates" . '/' . $fileName,
            ]);
        }
        // // Send email to user
        // Mail::to($user->email)->send(new CertificateEmail($certificate));

        $this->info('Certificate generated, stored, and email sent successfully.');
    }
}
