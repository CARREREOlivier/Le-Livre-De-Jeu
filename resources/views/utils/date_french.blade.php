<!--date snippet-->
@php
    $date_string = date('d-M-Y à H:i', strtotime($date));

    // Array containing search string
    $search_values= array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec') ;

    // Array containing replace string from  search string
    $replace_values= array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre') ;

    $date_french=str_replace($search_values, $replace_values, $date_string);

 echo $date_french;
@endphp
<!--end date snippet-->