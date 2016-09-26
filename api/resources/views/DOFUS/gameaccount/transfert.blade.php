@extends('layouts.contents.default')
@include('layouts.menus.base')

@section('breadcrumbs')
{!! Breadcrumbs::render('gameaccount.page', 'Transférer des Ogrines', [$account->server, $account->Id]) !!}
@stop

@section('content')
<div class="ak-container ak-main-center">
    <div class="ak-title-container ak-backlink">
        <h1><span class="ak-icon-big ak-bank"></span></a> Transférer des Ogrines</h1>
        <a href="{{ URL::route('gameaccount.view', [$account->server, $account->Id]) }}" class="ak-backlink-button">Retour à mon compte</a>
    </div>

    <div class="ak-container ak-panel-stack">
        <div class="ak-container ak-panel ak-glue">
            <div class="ak-panel-content">
                <div class="panel-main ak-form">
                    {!! Form::open(['route' => ['gameaccount.transfert', $account->server, $account->Id]]) !!}

                    <div class="form-group">
                        <label class="control-label" for="ogrinesWeb">Ogrines disponible</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="ak-icon-small ak-ogrines-icon"></span></span>
                            <input type="text" class="form-control ak-tooltip" value="{{ Utils::format_price(Auth::user()->points, ' ') }}" id="ogrinesWeb" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="ogrinesGame">Ogrines en jeu ({{ $account->Nickname }})</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="ak-icon-small ak-ogrines-icon"></span></span>
                            <input type="text" class="form-control ak-tooltip" value="{{ Utils::format_price($account->points(), ' ') }}" id="ogrinesGame" readonly />
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('ogrines')) has-error @endif">
                        <label class="control-label" for="ogrines">Ajouter des Ogrines</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="ak-icon-small ak-ogrines-icon"></span></span>
                            <input type="text" class="form-control ak-tooltip" tabindex="1" autocomplete="off" name="ogrines" placeholder="Saisir le nombre d'Ogrines à transférer" value="{{ Input::old('ogrines') }}" id="ogrines" autocapitalize="off" autocorrect="off" required="required" />
                        </div>
                        @if ($errors->has('ogrines')) <label class="error control-label">{{ $errors->first('ogrines') }}</label> @endif
                    </div>

                    <input type="submit" role="button" class="btn btn-primary btn-lg" value="Transférer">
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
