<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Krucas\LaravelUserEmailVerification\Contracts\RequiresEmailVerification as RequiresEmailVerificationContract;
use Krucas\LaravelUserEmailVerification\RequiresEmailVerification;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable implements RequiresEmailVerificationContract
{
    use RequiresEmailVerification,EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email', 'password',
        'title',
        'company_id',
        'language_id',
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * Associate user/owner with contacts 
     * User has many contacts
     */
    public function contacts(){
        return $this->hasMany(Contact::class);
    }

    /*
     * Helper method: Add contact
     */
    public function addContact(Contact $contact){
        return $this->contacts()->save($contact);
    }
    
    /*
     * Associate Users to other events
     * User has many events
     */
    public function events(){
        return  $this->belongsToMany(Event::class)->withPivot('status')->withTimestamps();
    }
    /*
     * Helper method for assigning Inviting USER to EVENT
     */
    public function inviteTo(Event $event, $status){
        return $this->events()->save($event,['status'=>$status]);
    }

    /*
     * Helper method: update users status
     * $user->responds
     */
    public function responds($event_id, $status){
        return $this->events()->updateExistingPivot($event_id,['status'=>$status]);
    }

    /*
     * Helper method: User answer invitation
     * $user answer invitation
     */
    public function answerInvitation($event_id,$answer){
        return $this->events()->updateExistingPivot($event_id,['status'=>$answer]);
    }

    /*
     * Retrieve data for calendar API
     * same as [events()] but restricted to
     * limited columns
     */
    public function calendarAPI(){
        return $this->belongsToMany(Event::class)
                    ->select([
                        'events.id',
                        'name',
                        'events.title',
                        'events.start_time as start',
                        'events.end_time as end'
                    ]);
//                    ->where('end_time','>=',Carbon::now());
    }
    /*
     * Associate User to Company
     * A user can only have one company
     */
    public function company(){
        return $this->belongsTo(Company::class,'company_id');
    }

    /*
     * Helper method: set user's company
     */
    public function setCompany(Company $company){
        return $this->company()->save($company);
    }
    /*
     * Associate User to Language
     * A user can only use one language
     * but still can change in the settings
     */
    public function language(){
        return $this->belongsTo(Language::class);
    }
    /*
     * Helper method: set user's language
     */
    public function setLanguage(Language $language){
        return $this->language()->save($language);
    }

//    /*
//     * Associate User with Roles
//     */
//    public function roles(){
//        return $this->belongsToMany(Role::class);
//    }
//    /*
//     * Helper method: User act as [role] e.g: manager
//     */
//    public function actAs(Role $role){
//        return  $this->roles()->save($role);
//    }

    /*
     * Associate User to gender
     * A user can only have one gender
     */
    public function gender(){
        return $this->belongsTo(Gender::class,'gender_id');
    }
    /*
     * Helper method: User can only have 1 gender
     * from the list
     */
    public function setGender(Gender $gender){
        return $this->gender()->save($gender);
    }
}
