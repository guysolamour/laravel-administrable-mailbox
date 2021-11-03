<?php

namespace Guysolamour\Administrable\Extensions\Mailbox\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Guysolamour\Administrable\Models\BaseModel;
use Guysolamour\Administrable\Traits\CommentableTrait;
use Guysolamour\Administrable\Traits\SluggableTrait;

class Mailbox extends BaseModel
{
    use Sluggable;
    use CommentableTrait;
    use SluggableTrait;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'extensions_mailboxes';


    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    public $fillable = ['email', 'phone_number', 'content', 'name', 'slug', 'read'];


    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'read' => 'boolean',
    ];

    protected $sluggablefield = 'name';


    public function notes()
    {
        return $this->comments();
    }


    // Attributes
    public function scopeUnread($query)
    {
        return $query->where('read',false);
    }

    public function scopeRead($query)
    {
        return $query->where('read',true);
    }


    // add relation methods below

    public function markAsRead()
    {
        if (!$this->read) {
            $this->update(['read' => true]);
        }
    }
}
