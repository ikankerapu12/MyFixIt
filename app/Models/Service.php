<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function type(){
        return $this->belongsTo(ServiceType::class,'stype_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'technician_id','id');
    }

    public function sseksyen(){
        return $this->belongsTo(Seksyen::class,'seksyen','id');
    }

    public function reviews(){
        return $this->hasMany(ServiceReview::class, 'service_id', 'id');
    }

    public function getAverageRatingAttribute(){
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getReviewCountAttribute(){
        return $this->reviews()->count();
    }

}
