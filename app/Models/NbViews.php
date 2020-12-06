<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * NbViews model
 */
class NbViews extends Model
{
    use HasFactory;

    /**
     * Свойство определяющее состояние отметки времени
     *
     * @var bool
     */
    public $timestamps = false;
}
