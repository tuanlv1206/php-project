<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\City
 *
 * @property boolean $id
 * @property string $name
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\District[] $districts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\House[] $houses
 * @method static \Illuminate\Database\Query\Builder|\App\City whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\City whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\City whereSlug($value)
 */
	class City extends \Eloquent {}
}

namespace App{
/**
 * App\Direction
 *
 * @property boolean $id
 * @property string $name
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\House[] $houses
 * @method static \Illuminate\Database\Query\Builder|\App\Direction whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Direction whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Direction whereSlug($value)
 */
	class Direction extends \Eloquent {}
}

namespace App{
/**
 * App\District
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property boolean $city_id
 * @property-read \App\City $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ward[] $wards
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Street[] $streets
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\House[] $houses
 * @method static \Illuminate\Database\Query\Builder|\App\District whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\District whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\District whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\District whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\District whereCityId($value)
 */
	class District extends \Eloquent {}
}

namespace App{
/**
 * App\House
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property boolean $city_id
 * @property integer $district_id
 * @property integer $ward_id
 * @property integer $street_id
 * @property string $address
 * @property boolean $type_id
 * @property boolean $direction_id
 * @property float $square
 * @property float $price
 * @property string $description
 * @property boolean $rooms
 * @property boolean $bedrooms
 * @property boolean $bathrooms
 * @property boolean $toilets
 * @property boolean $floors
 * @property float $facade
 * @property string $avatar
 * @property string $video
 * @property boolean $status
 * @property boolean $approved
 * @property integer $owner_id
 * @property integer $author_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Image[] $images
 * @property-read \App\City $city
 * @property-read \App\District $district
 * @property-read \App\Ward $ward
 * @property-read \App\Street $street
 * @property-read \App\Type $type
 * @property-read \App\Direction $direction
 * @property-read \App\Owner $owner
 * @property-read \App\User $author
 * @method static \Illuminate\Database\Query\Builder|\App\House whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereCityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereDistrictId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereWardId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereStreetId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereDirectionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereSquare($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereRooms($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereBedrooms($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereBathrooms($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereToilets($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereFloors($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereFacade($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereVideo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereApproved($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereAuthorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\House whereUpdatedAt($value)
 */
	class House extends \Eloquent {}
}

namespace App{
/**
 * App\Image
 *
 * @property integer $id
 * @property string $name
 * @property integer $house_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\House $house
 * @method static \Illuminate\Database\Query\Builder|\App\Image whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Image whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Image whereHouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Image whereUpdatedAt($value)
 */
	class Image extends \Eloquent {}
}

namespace App{
/**
 * App\Owner
 *
 * @property integer $id
 * @property string $name
 * @property string $home_phone
 * @property string $mobile_phone1
 * @property string $mobile_phone2
 * @property string $email
 * @property string $address
 * @property string $note
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\House[] $houses
 * @method static \Illuminate\Database\Query\Builder|\App\Owner whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Owner whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Owner whereHomePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Owner whereMobilePhone1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Owner whereMobilePhone2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Owner whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Owner whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Owner whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Owner whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Owner whereUpdatedAt($value)
 */
	class Owner extends \Eloquent {}
}

namespace App{
/**
 * App\SocialAccount
 *
 * @property integer $user_id
 * @property string $provider_user_id
 * @property string $provider
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\SocialAccount whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SocialAccount whereProviderUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SocialAccount whereProvider($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SocialAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SocialAccount whereUpdatedAt($value)
 */
	class SocialAccount extends \Eloquent {}
}

namespace App{
/**
 * App\Street
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $district_id
 * @property-read \App\District $district
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\House[] $houses
 * @method static \Illuminate\Database\Query\Builder|\App\Street whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Street whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Street whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Street whereDistrictId($value)
 */
	class Street extends \Eloquent {}
}

namespace App{
/**
 * App\Type
 *
 * @property boolean $id
 * @property string $name
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\House[] $houses
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereSlug($value)
 */
	class Type extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\House[] $houses
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Ward
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property integer $district_id
 * @property-read \App\District $district
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\House[] $houses
 * @method static \Illuminate\Database\Query\Builder|\App\Ward whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ward whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ward whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ward whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ward whereDistrictId($value)
 */
	class Ward extends \Eloquent {}
}

