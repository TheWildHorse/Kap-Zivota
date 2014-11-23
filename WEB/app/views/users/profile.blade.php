@extends('layouts.scaffoldSuperAdmin')

@section('main')

<div class="row">
    <div class="col-md-12">
        <h1 class="text-center">Prikaz Korisnika</h1>

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

{{ Form::model($user, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('users.update', $user->id))) }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('username', 'Korisničko ime:', array('class'=>'col-md-4 control-label')) }}
                      <div class="col-sm-8">

                                     <text class="form-control">
                                          <?php echo $user->username; ?>
                                    </text>
                                    </div>
                </div>
                <div class="form-group">
                     {{ Form::label('gender', 'Spol:', array('class'=>'col-md-4 control-label')) }}
                       <div class="col-sm-8">

                                      <text class="form-control">
                                           <?php echo $user->gender; ?>
                                     </text>
                                     </div>
                </div>
                <div class="form-group">
                     {{ Form::label('email', 'Email:', array('class'=>'col-md-4 control-label')) }}
                      <div class="col-sm-8">

                                     <text class="form-control">
                                          <?php echo $user->email; ?>
                                    </text>
                                    </div>
                </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('name', 'Ime:', array('class'=>'col-md-4 control-label')) }}
                      <div class="col-sm-8">

                                     <text class="form-control">
                                          <?php echo $user->name; ?>
                                    </text>
                                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('surname', 'Prezime:', array('class'=>'col-md-4 control-label')) }}
                      <div class="col-sm-8">

                                     <text class="form-control">
                                          <?php echo $user->surname; ?>
                                    </text>
                                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('birthdate', 'Datum rođenja:', array('class'=>'col-md-4 control-label')) }}
                    <div class="col-sm-8">

                 <text class="form-control">
                      <?php echo $user->birthdate; ?>
                </text>
                </div>
                </div>
            </div>
            <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-md-4 control-label">Broj donacija</label>
                               <div class="col-sm-8">
                                  <text class="form-control">
                                  <?php
                                    $numberOfDonations = Donation::where('user_id','=',$user->id)->get()->count();
                                    $results = DB::select( DB::raw("SELECT name FROM achivements WHERE number < :somevariable"), array(
                                                'somevariable' => $numberOfDonations,
                                            ));
                                    echo $numberOfDonations;
                                    ?>
                                    </text>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Korisnikova postignuća</label>
                                <div class="col-sm-12">
                                 <text class="form-control"><?php foreach( json_decode( json_encode($results),true) as $i)

                                  {
                                  echo $i["name"].", ";
                                  }

                                  ?></text>
                                 </div>
                            </div>
                  </div>
        </div>










<div class="form-group text-center">
    <div class="col-sm-12">

      {{ link_to_action('UsersController@showUsers', 'Natrag na popis', $user->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop