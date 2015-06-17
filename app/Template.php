<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for templates
 */
class Template extends Model
{
    /**
     * Fields to show in the JSON presentation
     *
     * @var array
     */
    protected $visible = ['id', 'name', 'command_count'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'is_template', 'group_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * Additional attributes to include in the JSON representation.
     *
     * @var array
     */
    protected $appends = ['command_count'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_template' => 'boolean'
    ];

    /**
     * Query scope to only show templates
     *
     * @param object $query
     * @return object
     */
    public function scopeTemplates($query)
    {
        return $query->where('is_template', '=', true);
    }

    /**
     * Define a accessor for the count of projects.
     *
     * @return int
     */
    public function getCommandCountAttribute()
    {
        return $this->commands()
                    ->count();
    }

    /**
     * Has many relationship.
     *
     * @return Command
     */
    public function commands()
    {
        return $this->hasMany('App\Command', 'project_id');
    }

    /**
     * Has many relationship.
     *
     * @return SharedFile
     */
    public function shareFiles()
    {
        return $this->hasMany('App\SharedFile', 'project_id');
    }

    /**
     * Has many relationship to project file.
     *
     * @return ProjectFile
     */
    public function projectFiles()
    {
        return $this->hasMany('App\ProjectFile', 'project_id');
    }
}
