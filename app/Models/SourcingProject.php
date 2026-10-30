<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class SourcingProject extends Model
{
    use HasFactory;

    public const STAGE_SAMPLING = 'sampling';
    public const STAGE_PRODUCTION = 'production';
    public const STAGE_QUALITY_CONTROL = 'quality_control';
    public const STAGE_PACKING_STUFFING = 'packing_stuffing';
    public const STAGE_SHIPPING = 'shipping';
    public const STAGE_DELIVERED = 'delivered';
    public const STAGE_ON_HOLD = 'on_hold';

    protected $fillable = [
        'quotation_id',
        'project_code',
        'access_token',
        'title',
        'category_id',
        'client_name',
        'client_company',
        'client_email',
        'client_whatsapp',
        'client_country',
        'workshop_name',
        'workshop_location',
        'stage',
        'progress_percent',
        'target_completion_date',
        'estimated_shipping_date',
        'qc_passed_at',
        'qc_notes',
        'internal_notes',
        'client_notes',
        'photos',
        'timeline_updates',
    ];

    protected function casts(): array
    {
        return [
            'photos' => 'array',
            'timeline_updates' => 'array',
            'target_completion_date' => 'date',
            'estimated_shipping_date' => 'date',
            'qc_passed_at' => 'datetime',
            'progress_percent' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (SourcingProject $project) {
            if (empty($project->project_code)) {
                $year = date('Y');
                $count = static::whereYear('created_at', $year)->count() + 1;
                $project->project_code = sprintf('PRJ-%s-%04d', $year, $count);
            }

            if (empty($project->access_token)) {
                $project->access_token = 'trk_' . Str::random(24);
            }
        });
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getTrackingUrlAttribute(): string
    {
        return url('/track/' . $this->access_token);
    }

    public static function getStages(): array
    {
        return [
            self::STAGE_SAMPLING => 'Pembuatan Sampel (Sampling & Prototype)',
            self::STAGE_PRODUCTION => 'Produksi Massal (Mass Production)',
            self::STAGE_QUALITY_CONTROL => 'Inspeksi Kualitas (Quality Control)',
            self::STAGE_PACKING_STUFFING => 'Pengepakan & Muat Kontainer (Packing & Stuffing)',
            self::STAGE_SHIPPING => 'Pengiriman Kargo (Shipping / In Transit)',
            self::STAGE_DELIVERED => 'Pesanan Tiba (Delivered)',
            self::STAGE_ON_HOLD => 'Ditunda Sementara (On Hold)',
        ];
    }

    public function getStageLabelAttribute(): string
    {
        return self::getStages()[$this->stage] ?? ucfirst(str_replace('_', ' ', $this->stage));
    }

    /**
     * Generate customized WhatsApp update message for client based on current stage
     */
    public function getWhatsAppUpdateText(): string
    {
        $trackingUrl = $this->tracking_url;

        return match ($this->stage) {
            self::STAGE_SAMPLING => "Halo {$this->client_name}, tim Bali Easy Sourcing mengabarkan bahwa pembuatan sampel awal pesanan [{$this->project_code}: {$this->title}] telah selesai di workshop. Anda dapat memantau dokumentasi foto pengerjaan langsung di tautan resmi: {$trackingUrl}",
            self::STAGE_PRODUCTION => "Halo {$this->client_name}, produksi massal pesanan [{$this->project_code}: {$this->title}] di workshop saat ini telah mencapai {$this->progress_percent}%. Anda dapat melihat dokumentasi foto langsung di tautan: {$trackingUrl}",
            self::STAGE_QUALITY_CONTROL => "Halo {$this->client_name}, tim Bali Easy Sourcing baru saja menyelesaikan inspeksi Quality Control (QC) untuk pesanan [{$this->project_code}]. Seluruh item telah dicek kelembapan kayu, kekuatan sambungan, dan finishingnya. Laporan foto inspeksi dapat dilihat di: {$trackingUrl}",
            self::STAGE_PACKING_STUFFING => "Halo {$this->client_name}, pesanan [{$this->project_code}: {$this->title}] telah selesai dikemas rapi dengan standar ekspor dan siap dimuat ke dalam kontainer kargo. Pantau status terbaru di: {$trackingUrl}",
            self::STAGE_SHIPPING => "Halo {$this->client_name}, kargo pesanan [{$this->project_code}] telah diberangkatkan menuju pelabuhan tujuan. Terima kasih telah mempercayakan kurasi kriya Bali bersama kami! Tautan pelacakan: {$trackingUrl}",
            self::STAGE_DELIVERED => "Halo {$this->client_name}, pesanan [{$this->project_code}] telah berhasil tiba di lokasi. Terima kasih atas kerja samanya bersama Bali Easy Sourcing!",
            default => "Halo {$this->client_name}, berikut kami kirimkan pembaruan status pengerjaan pesanan [{$this->project_code}] di Bali Easy Sourcing. Anda dapat memantau dokumentasi pengerjaan langsung di: {$trackingUrl}",
        };
    }
}
