@extends('layouts.scaffoldSuperAdmin')

@section('main')

<div class="row">
    <div class="col-md-12">
        <h1 class="text-center">Profil - <?php echo $user->username; ?></h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>
<br>
<h3 class="text-center">Broj donacija:<?php $numberOfDonations = Donation::where('user_id','=',$user->id)->get()->count();
$results = DB::select( DB::raw("SELECT name FROM achivements WHERE number < :somevariable"), array(
            'somevariable' => $numberOfDonations,
        ));
echo $numberOfDonations;
?></h3>

<?php foreach( json_decode( json_encode($results),true) as $i) {
echo '<div class="row">
        <div class="col-md-6 well col-md-offset-3">
            <div class="col-md-2">
                <img class="img-responsive" src="'.asset("img/Trophy.png").'"/>
            </div>
            <div class="col-md-8">
                <h1 class="text-center">'.$i["name"].'</h1>
            </div>
        </div>
      </div>';
}?>

@stop