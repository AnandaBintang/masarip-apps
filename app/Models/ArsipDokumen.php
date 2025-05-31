<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipDokumen extends Model
{
    protected $table = 'arsip_dokumen';

    protected $fillable = [
        'kode_dokumen',
        'keterangan',
        'kategori',
        'perihal',
        'nama_dokumen',
        'tanggal_upload',
        'file_path',
        'file_name',
        'file_type',
    ];
    protected $casts = [
        'tanggal_upload' => 'date',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
    public function getFileSizeAttribute()
    {
        return filesize(storage_path('app/' . $this->file_path));
    }
    public function getFileTypeAttribute()
    {
        return $this->file_type ?: pathinfo($this->file_name, PATHINFO_EXTENSION);
    }
    public function getFileNameAttribute($value)
    {
        return $value ?: pathinfo($this->file_path, PATHINFO_BASENAME);
    }
    public function getFilePathAttribute($value)
    {
        return $value ?: 'default/path/to/file';
    }
    public function getFileExtensionAttribute()
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION);
    }
    public function getFileSizeFormattedAttribute()
    {
        $size = $this->getFileSizeAttribute();
        if ($size < 1024) {
            return $size . ' B';
        } elseif ($size < 1048576) {
            return round($size / 1024, 2) . ' KB';
        } elseif ($size < 1073741824) {
            return round($size / 1048576, 2) . ' MB';
        } else {
            return round($size / 1073741824, 2) . ' GB';
        }
    }
}
