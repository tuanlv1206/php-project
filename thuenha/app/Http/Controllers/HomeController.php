<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
  public function getIndex()
  {
    // Get all types to bind to select options
    $types = array('' => trans('house/create.type_hint'));
    $types += \App\Type::getAllToSelect();

    // Get all districts to bind to select option
    $districts = array('' => trans('house/create.district_hint'));
    $districts += \App\District::getAllToSelect();

    // We only show wards and streets when district is specific so we just initialize an empty select option with hint
    $wards = array('' => trans('house/create.ward_hint'));
    $streets = array('' => trans('house/create.street_hint'));


    // Populate numbers of bedrooms to bind to select options
    $beds = array('' => trans('home/search.beds_hint'));
    for ($i = 1; $i <= 6; $i++)
    {
      $beds += array($i => $i.'+');
    }

    // Get all directions to bind to select options
    $directions = array('' => trans('house/create.direction_hint'));
    $directions += \App\Direction::getAllToSelect();

    // Initialize default search options
    $skeyword = '';
    $stype_id = '';
    $sdistrict_id = '';
    $sward_id = '';
    $sstreet_id = '';
    $ssquare_min = '';
    $ssquare_max = '';
    $sprice_min = '';
    $sprice_max = '';
    $sbeds = '';
    $sdirection_id = '';
    $sort_type = 0;

    // Get list of houses, links and total houses
    $result = \App\House::search($skeyword, $stype_id, $sdistrict_id, $sward_id, $sstreet_id, $ssquare_min, $ssquare_max, $sprice_min, $sprice_max, $sbeds, $sdirection_id, $sort_type);

    return view('home.index', array('skeyword' => $skeyword, 'types' => $types, 'stype_id' => $stype_id, 'districts' => $districts, 'sdistrict_id' => $sdistrict_id, 'wards' => $wards, 'sward_id' => $sward_id, 'streets' => $streets, 'sstreet_id' => $sstreet_id, 'ssquare_min' => $ssquare_min, 'ssquare_max' => $ssquare_max, 'sprice_min' => $sprice_min, 'sprice_max' => $sprice_max, 'beds' => $beds, 'sbeds' => $sbeds, 'directions' => $directions, 'sdirection_id' => $sdirection_id, 'sort_type' => $sort_type, 'heading' => trans('home/list.default_heading'), 'heading2' => '', 'af_visibility' => false, 'links' => $result['links'], 'total' => $result['total'], 'houses' => $result['houses'], 'all_count' => $result['total']));
  }

  public function postIndex(Request $request)
  {
    // Replace all non alphanumeric characters and trim spaces around keyword
    $keyword = trim(preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword));

    // Build url based on search options.
    // To make url as short as possible, we use absent info to determine which fields are not selected.
    // Url format: <type_slug>--tai-<street_slug>--<ward_slug>--<district_slug>--<city_slug>--dien-tich-<square_min>m2--<square_max>m2--gia-<price_min>-trieu-thang--<price_max>-trieu-thang--<beds>-phong-ngu--huong-<direction_slug>--<keyword>--<absent_info>/<sort_type>
    // There are 12 fields (type_id, city_id, street_id, ward_id, district_id, square_min, square_max, price_min, price_max, beds, direction_id and keyword) so we use binary number 111111111111 (4095) to present all fields are present. if any field in order is absent, the value at its position will be 0. For example, if the type_id is absent, the absent info will be 011111111111 (2047).
    $url = '';
    $absent_info = 0;

    if ($request->type_id != '')
    {
      $url .= \App\Type::getSlugById($request->type_id);
      $absent_info += 1;
      $url .= '--';
    }
    else
      $url .= trans('home/list.no_type__url_prefix');

    // Currently we support only Hanoi market and all houses are in Hanoi.
    $city_id = 1;
    if ($city_id != ''|| $request->street_id != '' || $request->ward_id != '' || $request->district_id != '')
    {
      $url .= 'tai-';
      if ($request->street_id != '')
      {
        $url .= \App\Street::getSlugById($request->street_id);
        $absent_info += 2;
        $url .= '--';
      }

      if ($request->ward_id != '')
      {
        $url .= \App\Ward::getSlugById($request->ward_id);
        $absent_info += 4;
        $url .= '--';
      }

      if ($request->district_id != '')
      {
        $url .= \App\District::getSlugById($request->district_id);
        $absent_info += 8;
        $url .= '--';
      }

      if ($city_id != '')
      {
        $url .= 'ha-noi';
        $absent_info += 16;
        $url .= '--';
      }
    }

    if ((float)$request->square_min != 0 || (float)$request->square_max != 0)
    {
      $url .= 'dien-tich-';
      if ((float)$request->square_min != 0)
      {
        $url .= (float)$request->square_min;
        $url .= 'm2--';
        $absent_info += 32;
      }

      if ((float)$request->square_max != 0)
      {
        $url .= (float)$request->square_max;
        $url .= 'm2--';
        $absent_info += 64;
      }
    }

    if ((float)$request->price_min != 0 || (float)$request->price_max != 0)
    {
      $url .= 'gia-';
      if ((float)$request->price_min != 0)
      {
        $url .= (float)$request->price_min;
        $url .= '-trieu-thang--';
        $absent_info += 128;
      }

      if ((float)$request->price_max != 0)
      {
        $url .= (float)$request->price_max;
        $url .= '-trieu-thang--';
        $absent_info += 256;
      }
    }

    if ($request->beds != '')
    {
      $url .= $request->beds;
      $url .= '-phong-ngu--';
      $absent_info += 512;
    }

    if ($request->direction_id != '')
    {
      $url .= 'huong-';
      $url .= \App\Direction::getSlugById($request->direction_id);
      $absent_info += 1024;
      $url .= '--';
    }

    if ($keyword != '')
    {
      $url .= str_replace(' ', '_', $keyword);
      $absent_info += 2048;
      $url .= '--';
    }

    // If user select at least one field, we will add the absent info to the url
    if ($absent_info > 0)
      $url .= $absent_info;

    // If sort type is not equals 0, we add sort typ to the url
    if ($request->sort != 0)
    {
      $url .= '/';
      $url .= $request->sort;
    }

    return redirect($url);
  }

  public function getSearch($search_query, $sort_type = 0)
  {
    // We only accept sort type is one of 0, 1, 2, 3, 4
    if ((int)$sort_type < 0 || (int)$sort_type > 4) return redirect('/');

    // search query format: <type_slug>--tai-<street_slug>--<ward_slug>--<district_slug>--<city_slug>--dien-tich-<square_min>m2--<square_max>m2--gia-<price_min>-trieu-thang--<price_max>-trieu-thang--<beds>-phong-ngu--huong-<direction_slug>--<keyword>--<absent_info>

    // Firstly, we get the ebsent info to determine which fields are not selected
    $absent_pos = strrpos($search_query, '-'); // get position of absent info (or the index of last - character)
    $absent_info_str = substr($search_query, $absent_pos + 1); // get absent info string
    $absent_info = 0 + $absent_info_str; // convert string to int

    // If users select nothing, redirect to home page
    if ($absent_info == 0)
      return redirect('/');

    // Initialize selected fields
    $skeyword = '';
    $stype_id = '';
    $sdistrict_id = '';
    $sward_id = '';
    $sstreet_id = '';
    $ssquare_min = '';
    $ssquare_max = '';
    $sprice_min = '';
    $sprice_max = '';
    $sbeds = '';
    $sdirection_id = '';

    // Initialize some default values
    $af_visibility = false; // Which will determine advanced fields are visible or not

    // Get selected fields string
    $selected_fields = substr($search_query, 0, $absent_pos - 1);

    // Get array of selected fields
    $selected_array = explode('--', $selected_fields);
    // We will check whether a field is selected or not from left to right of the array.
    $counter = 0; // The counter variable only increases when there is a field selected
    $array_length = count($selected_array); // Number of elements in the array
    $heading = '';

    if ($absent_info & 1) // Type is selected
    {
      if ($counter >= $array_length) return redirect('/');
      $stype_id = \App\Type::getIdBySlug($selected_array[$counter]);
      if ($stype_id == '') return redirect('/');
      $heading .= \App\Type::getNameById($stype_id);
      $heading .= ' ';
      $counter++;
    }
    else
    {
      $heading .= trans('home/list.heading_prefix');
      $heading .= ' ';
      $counter++;
    }

    $heading .= trans('home/list.at');
    $heading .= ' ';
    if ($absent_info & 2 || $absent_info & 4 || $absent_info & 8) // If users select any of street, ward, district we don't need to include city to the heading
    {

      if ($absent_info & 2) // Street is selected
      {
        if ($counter >= $array_length) return redirect('/');
        $sstreet_id = \App\Street::getIdBySlug(substr($selected_array[$counter], 4)); // We remove string 'tai-' from slug
        if ($sstreet_id == '') return redirect('/');
        $heading .= \App\Street::getFullNameById($sstreet_id);
        $heading .= ', ';
        $counter++;
        $af_visibility = true;
      }

      if ($absent_info & 4) // Ward is selected
      {
        if ($counter >= $array_length) return redirect('/');
        if ($absent_info & 2)
          $sward_id = \App\Ward::getIdBySlug($selected_array[$counter]);
        else
          $sward_id = \App\Ward::getIdBySlug(substr($selected_array[$counter], 4));
        if ($sward_id == '') return redirect('/');
        $heading .= \App\Ward::getFullNameById($sward_id);
        $heading .= ', ';
        $counter++;
        $af_visibility = true;
      }

      if ($absent_info & 8) // District is selected
      {
        if ($counter >= $array_length) return redirect('/');
        if ($absent_info & 2 || $absent_info & 4)
          $sdistrict_id = \App\District::getIdBySlug($selected_array[$counter]);
        else
          $sdistrict_id = \App\District::getIdBySlug(substr($selected_array[$counter], 4));
        if ($sdistrict_id == '') return redirect('/');
        $heading .= \App\District::getFullNameById($sdistrict_id);
        $heading .= ' ';
        $counter++;
      }
    }
    else
    {
      $heading .= trans('home/list.hanoi');
      $heading .= ' ';
    }

    if ($absent_info & 16) // city id is selected
    {
      if ($counter >= $array_length) return redirect('/');
      // Currently we only support Hanoi market so we don't accept other cities
      if ($absent_info & 2 || $absent_info & 4 || $absent_info & 8)
      {
        if ($selected_array[$counter] != 'ha-noi')
          return redirect('/');
      }
      else
      {
        if (substr($selected_array[$counter], 4) != 'ha-noi')
          return redirect('/');
      }
      $counter++;
    }

    if ($absent_info & 32) // Square min is selected
    {
      if ($counter >= $array_length) return redirect('/');
      $ssquare_min = (float)substr($selected_array[$counter], 10, strlen($selected_array[$counter]) - 12); // Remove dien-tich- and m2 from square min
      $counter++;
    }

    if ($absent_info & 64) // Square max is selected
    {
      if ($counter >= $array_length) return redirect('/');
      if ($absent_info & 32)
        $ssquare_max = (float)substr($selected_array[$counter], 0, strlen($selected_array[$counter]) - 2); // Remove m2 from square max
      else
        $ssquare_max = (float)substr($selected_array[$counter], 10, strlen($selected_array[$counter]) - 12); // Remove dien-tich- and m2 from square max
      $counter++;
    }

    if ($absent_info & 128) // Price min is selected
    {
      if ($counter >= $array_length) return redirect('/');
      $sprice_min = (float)substr($selected_array[$counter], 4, strlen($selected_array[$counter]) - 16); // Remove gia- and -trieu-thang from price min
      $counter++;
    }

    if ($absent_info & 256) // Price max is selected
    {
      if ($counter >= $array_length) return redirect('/');
      if ($absent_info & 128)
        $sprice_max = (float)substr($selected_array[$counter], 0, strlen($selected_array[$counter]) - 12); // Remove -trieu-thang from price max
      else
        $sprice_max = (float)substr($selected_array[$counter], 4, strlen($selected_array[$counter]) - 16); // Remove gia- and -trieu-thang from price max
      $counter++;
    }

    if ($absent_info & 512) // Beds is selected
    {
      if ($counter >= $array_length) return redirect('/');
      $sbeds = (int)substr($selected_array[$counter], 0, strlen($selected_array[$counter]) - 10);
      $counter++;
      $af_visibility = true;
    }

    if ($absent_info & 1024) // Direction is selected
    {
      if ($counter >= $array_length) return redirect('/');
      $sdirection_id = \App\Direction::getIdBySlug(substr($selected_array[$counter], 6));
      if ($sdirection_id == '') return redirect('/');
      $counter++;
      $af_visibility = true;
    }

    if ($absent_info & 2048) // Keyword is filled
    {
      if ($counter >= $array_length) return redirect('/');
      $skeyword = str_replace('_', ' ', $selected_array[$counter]);
      $counter++;
    }

    // Get list of houses and pagination links
    $result = \App\House::search($skeyword, $stype_id, $sdistrict_id, $sward_id, $sstreet_id, $ssquare_min, $ssquare_max, $sprice_min, $sprice_max, $sbeds, $sdirection_id, $sort_type);

    // Get all types to bind to select options
    $types = array('' => trans('house/create.type_hint'));
    $types += \App\Type::getAllToSelect();

    // Get all districts to bind to select option
    $districts = array('' => trans('house/create.district_hint'));
    $districts += \App\District::getAllToSelect();

    // Initialize default option for wards and streets select options
    $wards = array('' => trans('house/create.ward_hint'));
    $streets = array('' => trans('house/create.street_hint'));
    // If district is selected we get all wards and streets to bind to select options
    if ($sdistrict_id != '')
    {
      $wards += \App\Ward::getWardsByDistrictId($sdistrict_id);
      $streets += \App\Street::getStreetsByDistrictId($sdistrict_id);
    }

    // Populate numbers of bedrooms to bind to select options
    $beds = array('' => trans('home/search.beds_hint'));
    for ($i = 1; $i <= 6; $i++)
    {
      $beds += array($i => $i.'+');
    }

    // Get all directions to bind to select options
    $directions = array('' => trans('house/create.direction_hint'));
    $directions += \App\Direction::getAllToSelect();

    // Build heading 2
    $heading2 = '';
    // If users select only city (currently user select nothing), we don't display heading 2.
    if ($absent_info != 16)
    {
      if ($sdistrict_id != '')
      {
        $heading2 .= ' '.trans('home/list.district').': ';
        $heading2 .= '<span class="criteria-info">'.\App\District::getNameById($sdistrict_id).'</span>.';
      }

      if ($sward_id != '')
      {
        $heading2 .= ' '.trans('home/list.ward').': ';
        $heading2 .= '<span class="criteria-info">'.\App\Ward::getNameById($sward_id).'</span>.';
      }

      if ($sstreet_id != '')
      {
        $heading2 .= ' '.trans('home/list.street').': ';
        $heading2 .= '<span class="criteria-info">'.\App\Street::getNameById($sstreet_id).'</span>.';
      }

      if ($sprice_min != '' && $sprice_max != '')
      {
        $heading2 .= ' '.trans('home/list.price').': ';
        $heading2 .= '<span class="criteria-info">'.$sprice_min.' - '.$sprice_max.' '.trans('home/list.price_unit').'</span>.';
      }
      else if ($sprice_min != '')
      {
        $heading2 .= ' '.trans('home/list.price').': ';
        $heading2 .= '<span class="criteria-info">&ge; '.$sprice_min.' '.trans('home/list.price_unit').'</span>.';
      }
      else if ($sprice_max != '')
      {
        $heading2 .= ' '.trans('home/list.price').': ';
        $heading2 .= '<span class="criteria-info">&le; '.$sprice_max.' '.trans('home/list.price_unit').'</span>.';
      }

      if ($ssquare_min != '' && $ssquare_max != '')
      {
        $heading2 .= ' '.trans('home/list.square').': ';
        $heading2 .= '<span class="criteria-info">'.$ssquare_min.' - '.$ssquare_max.' '.trans('home/list.square_unit').'</span>.';
      }
      else if ($ssquare_min != '')
      {
        $heading2 .= ' '.trans('home/list.square').': ';
        $heading2 .= '<span class="criteria-info">&ge; '.$ssquare_min.' '.trans('home/list.square_unit').'</span>.';
      }
      else if ($ssquare_max != '')
      {
        $heading2 .= ' '.trans('home/list.square').': ';
        $heading2 .= '<span class="criteria-info">&le; '.$ssquare_max.' '.trans('home/list.square_unit').'</span>.';
      }

      if ($sbeds != '')
      {
        $heading2 .= ' '.trans('home/list.beds').': ';
        $heading2 .= '<span class="criteria-info">'.$sbeds.'+</span>.';
      }

      if ($sdirection_id != '')
      {
        $heading2 .= ' '.trans('home/list.direction').': ';
        $heading2 .= '<span class="criteria-info">'.\App\Direction::getNameById($sdirection_id).'</span>.';
      }

      if ($skeyword != '')
      {
        $heading2 .= ' '.trans('home/list.keyword').': ';
        $heading2 .= '<span class="criteria-info">'.$skeyword.'</span>.';
      }

      if ($stype_id == '') // If users don't select type, we have no link at heading 2
      {
        $heading2 = trans('home/list.heading2_prefix').$heading2;
      }
      else
      {
        // If users don't select district, we don't create link for heading 2
        if ($sdistrict_id == '')
        {
          $heading2 = ' <span class="criteria-info">'.\App\Type::getNameById($stype_id).'</span>.'.$heading2;
          $heading2 = trans('home/list.heading2_prefix').$heading2;
        }
        else
        {
          $heading2_link = '/'.\App\Type::getSlugById($stype_id);
          $heading2_link .= '--tai-';
          $heading2_text = \App\Type::getNameById($stype_id);
          $heading2_text .= ' '.trans('home/list.at').' ';
          if ($sstreet_id != '')
          {
            $heading2_link .= \App\Street::getSlugById($sstreet_id);
            $heading2_link .= '--'.\App\District::getSlugById($sdistrict_id);
            $heading2_link .= '--ha-noi--27'; // Type, street, district and city is present, so absent info is 1 + 2 + 8 + 16 = 27
            $heading2_text .= \App\Street::getFullNameById($sstreet_id);
          }
          else if ($sward_id != '')
          {
            $heading2_link .= \App\Ward::getSlugById($sward_id);
            $heading2_link .= '--'.\App\District::getSlugById($sdistrict_id);
            $heading2_link .= '--ha-noi--29'; // Type, ward, district and city is present so absent info is 1 + 4 + 8 + 16 = 29
            $heading2_text .= \App\Ward::getFullNameById($sward_id);
          }
          else
          {
            $heading2_link .= \App\District::getSlugById($sdistrict_id);
            $heading2_link .= '--ha-noi--25'; // Type, district and city is present so absent info is 1 + 8 + 16 = 25
            $heading2_text .= \App\District::getFullNameById($sdistrict_id);
          }

          $heading2 = ' <a href="'.$heading2_link.'">'.$heading2_text.'</a>.'.$heading2;
          $heading2 = trans('home/list.heading2_prefix').$heading2;
        }
      }
    }

    return view('home.index', array('skeyword' => $skeyword, 'types' => $types, 'stype_id' => $stype_id, 'districts' => $districts, 'sdistrict_id' => $sdistrict_id, 'wards' => $wards, 'sward_id' => $sward_id, 'streets' => $streets, 'sstreet_id' => $sstreet_id, 'ssquare_min' => $ssquare_min, 'ssquare_max' => $ssquare_max, 'sprice_min' => $sprice_min, 'sprice_max' => $sprice_max, 'beds' => $beds, 'sbeds' => $sbeds, 'directions' => $directions, 'sdirection_id' => $sdirection_id, 'sort_type' => $sort_type, 'heading' => $heading, 'heading2' => $heading2, 'af_visibility' => $af_visibility, 'links' => $result['links'], 'total' => $result['total'], 'houses' => $result['houses'], 'all_count' => \App\House::getAllCount()));
  }
}

