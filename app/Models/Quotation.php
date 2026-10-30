<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quotation extends Model
{
    use HasFactory;

    public const STATUS_NEW = 'new';
    public const STATUS_CONTACTED = 'contacted';
    public const STATUS_QUOTED = 'quoted';
    public const STATUS_CLOSED = 'closed';
    public const STATUS_LOST = 'lost';

    protected $fillable = [
        'reference_no',
        'name',
        'company',
        'email',
        'whatsapp',
        'country',
        'category_id',
        'product_id',
        'description',
        'quantity',
        'target_date',
        'notes',
        'status',
        'internal_notes',
        'ip_address',
    ];

    protected function casts(): array
    {
        return [
            'target_date' => 'date',
        ];
    }

    /**
     * Auto generate reference number if not set.
     */
    protected static function booted(): void
    {
        static::creating(function (Quotation $quotation) {
            if (empty($quotation->reference_no)) {
                $year = date('Y');
                $count = static::whereYear('created_at', $year)->count() + 1;
                $quotation->reference_no = sprintf('RFQ-%s-%04d', $year, $count);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(QuotationAttachment::class);
    }

    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }
}
