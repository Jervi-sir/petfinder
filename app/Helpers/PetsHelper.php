<?php

use Carbon\Carbon;
use App\Models\Petbackup;
use App\Models\Translation;
use Illuminate\Support\Str;
use App\Models\ImagesToDelete;
use Illuminate\Support\Facades\URL;


    /**
     *  get Pets from object input.
     *
     *  @return \ data object
     */
    function getPets($pets) {
        $base_pet = URL::to('/pets') . '/';
        if($pets->count() == 0) {
            $data['pets'] = [];
        } else {
            foreach ($pets as $key => $pet) {
                $data['pets'][$key] = [
                    'url' => $base_pet . $pet->uuid,             //use uuid
                    'id' => $pet->id,
                    'name' => $pet->name,
                    'gender' => $pet->gender,
                    'race' => $pet->race->name,
                    'status' => $pet->offerType->name,
                    'wilaya' => $pet->wilaya->name,
                    'age' => getAge($pet->date_birth),
                    'image' => getFirstImage($pet->pics)
                ];
            }
        }
        return (object)$data['pets'];
    }

    /**
     *  Calculate age.
     *
     *  @return \ string
     */
    function getAge($date_birth) {
        $created = new Carbon($date_birth);
        $now = Carbon::now();
        $difference = ($now->from($created));

        $difference = str_replace(" before","",$difference);
        return str_replace(" after","",$difference);
    }

    /**
     *  Calculate age but old version.
     *
     *  @return \ string
     */
    function getAgeV1($date_birth)
    {
        $now = time(); // or your date as well
        $your_date = strtotime($date_birth);
        $datediff = $now - $your_date;
        $total = $datediff / (60 * 60 * 24);
        $age = '';
        if($total > 360) {
            $years = intval($total / 360);
            $total = $total - ($years * 360);
            $age = $years . 'y ';
        }
        if($total >= 30) {
            $leftMonths = intval($total % 30);
            $total = $total - ($leftMonths * 30);
            $age = $age . $leftMonths . 'm';
        }
        else {
            $leftDays = intval($total % 30);
            $total = $total - ($leftDays * 1);
            if(strpos($age, 'm') == false) {
                $age = $age . $leftDays . 'd';
            }
        }

        return $age;
    }

    /**
     *  get Unique uuid.
     *
     *  @return \ string with uuid, race. name
     */
    function uniqueUuid($race, $name)
    {
        $uuidString = (string) Str::uuid();
        $uuidFirst = substr($uuidString, 0, 5);
        $uuid = $uuidFirst . '_' . $race. '_' . str_replace(" ", "", $name);
        return $uuid;
    }

    /**
     *  inject url in image name.
     *
     *  @return \ string
     */
    function imagesToUrl($images) {
        $base_image = URL::to('/petImages') . '/';
        $pet_pics_with_url = [];
        $pet_pics = json_decode($images);
        foreach($pet_pics as $pic) {
            $url = $base_image . $pic;
            array_push($pet_pics_with_url, $url);
        }
        return $pet_pics_with_url;
    }

    /**
     *  get first image url.
     *
     *  @return \ string
     */
    function getFirstImage($images) {
        if(empty(json_decode($images))) {
            return '';
        }
        return imagesToUrl($images)[0];
    }

    function profileImageUrl($image) {
        $base_image = URL::to('/profileImages') . '/';
        return $base_image . $image;

    }

    function backupPet($pet) {

        $backup = new Petbackup();
        $backup->id = $pet->id;
        $backup->uuid = $pet->uuid;
        $backup->name = $pet->name;
        $backup->user_id = $pet->user_id;
        $backup->race_id = $pet->race_id;
        $backup->sub_race_id = $pet->sub_race_id;
        $backup->status_id = $pet->status_id;
        $backup->wilaya_id = $pet->wilaya_id;
        $backup->raceName = $pet->raceName;
        $backup->sub_raceName = $pet->sub_raceName;
        $backup->wilayaName = $pet->wilayaName;
        $backup->gender = $pet->gender;
        $backup->color = $pet->color;
        $backup->date_birth = $pet->date_birth;
        $backup->size = $pet->size;
        $backup->pics = $pet->pics;
        $backup->description = $pet->description;
        $backup->tags = $pet->tags;
        $backup->phone_number = $pet->phone_number;
        $backup->is_active = 0;
        $backup->announcement_status = "deleted";
        $backup->last_date_activated = $pet->last_date_activated;
        $backup->size = $pet->size;
        $backup->save();

        return true;
    }

    /**
     * input array
     *
     */
    function backupImages($images, $source, $type) {
        foreach ($images as $image) {
            $backup = new ImagesToDelete();
            $backup->source = $source;
            $backup->type = $type;
            $backup->name = $image;
            $backup->save();
        }

    }

    /**
     * input string
     * output array
        //turn keywords single line string into a keyword array
        //ignore what doesnt exist in db
     */
    function translateToEnglish($sentence) {
        $eng_keywords = [];
        $keywords = explode(" ", preg_replace("/[^A-Za-z0-9 ]\s+/", ' ', $sentence));

        foreach ($keywords as $key => $keyword) {
            $tmp = Translation::where('translation', 'like', '%'.$keyword.'%')->first();
            //if eng_word is null
            if($tmp == null) {
                continue;
            }
            $eng_keyword = $tmp->english_word;
            $score = $tmp->score;
            array_push($eng_keywords, $tmp->english_word);
            $data[$score]= $eng_keyword;
        }
        dd(($data));

        return $eng_keywords;
    }

