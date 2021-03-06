@extends('layouts.admin')
@section('content')
<div class="pusher">
    <div class="main-content">
        <div class="ui grid stackable padded">
            <div
                class="four wide computer eight wide tablet sixteen wide mobile column"
            >
                <div class="ui fluid card">
                    <div class="content">
                        <div class="ui right floated header red">
                            <i class="icon file"></i>
                        </div>
                        <div class="header">
                            @isset($count)
                                <div class="ui red header">
                                    {{ $count }}
                                </div>
                            @endisset
                        </div>
                        <div class="meta">
                            Fichiers mis en ligne
                        </div>
                        <div class="description">
                            @isset($count) Il y a au total {{ $count }} fichiers mis en ligne. @endisset
                        </div>
                    </div>
                    <div class="extra content">
                        <div class="ui two buttons">
                            <a class="ui red button" href="{{route('files')}}">Détails</a>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="four wide computer eight wide tablet sixteen wide mobile column"
            >
                <div class="ui fluid card">
                    <div class="content">
                        <div class="ui right floated header green">
                            <i class="icon clock"></i>
                        </div>
                        <div class="header">
                            <div class="ui header green">57.6%</div>
                        </div>
                        <div class="meta">
                            Time
                        </div>
                        <div class="description">
                            Elliot requested permission to view your contact details
                        </div>
                    </div>
                    <div class="extra content">
                        <div class="ui two buttons">
                            <a class="ui green button">Détails</a>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="four wide computer eight wide tablet sixteen wide mobile column"
            >
                <div class="ui fluid card">
                    <div class="content">
                        <div class="ui right floated header teal">
                            <i class="icon users"></i>
                        </div>
                        <div class="header">
                        @isset($users_count)
                            <div class="ui teal header">{{ $users_count }}</div>
                        @endisset
                        </div>
                        <div class="meta">
                            Utilisateurs inscrit
                        </div>
                        <div class="description">
                            {{$users_count}} utilisateurs sont inscrit sur le site.
                        </div>
                    </div>
                    <div class="extra content">
                        <div class="ui two buttons">
                            <a class="ui teal button" href="{{route('users')}}">Détails</a>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="four wide computer eight wide tablet sixteen wide mobile column"
            >
                <div class="ui fluid card">
                    <div class="content">
                        <div class="ui right floated header purple">
                            <i class="icon trophy"></i>
                        </div>
                        <div class="header">
                            <div class="ui purple header">9805</div>
                        </div>
                        <div class="meta">
                            Views
                        </div>
                        <div class="description">
                            Elliot requested permission to view your contact details
                        </div>
                    </div>
                    <div class="extra content">
                        <div class="ui two buttons">
                            <a class="ui purple button">Détails</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui grid stackable padded">
            <div class="column">
                <table class="ui celled striped table">
                    <thead>
                    <tr>
                        <th colspan="7">
                            Derniers fichiers ajoutés
                        </th>
                    </tr>
                    <tr>
                        <th width="25%">Lien</th>
                        <th>Titre</th>
                        <th>Type</th>
                        <th>Matière</th>
                        <th>Date d'upload</th>
                        <th>Date de mise à jour</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($files_last as $file)
                    <tr id="{{$file->id}}">
                        <td class="lien"><i class="file outline icon"></i>
                            @if($file->document == 1)
                                <a href="../licence/{{$file->matiere}}/download/{{$file->filename}}">{{$file->filename}}</a>
                            @elseif($file->document == 0)
                                <a href="{{$file->filename}}" target="_blank">{{$file->filename}}</a>
                            @endif
                        </td>
                        <td>{{ $file->title }}</td>
                        <td>{{ $file->type }}</td>
                        <td>{{ $file->matiere }}</td>
                        <td>{{ $file->created_at }}</td>
                        <td>{{ $file->updated_at }}</td><td class="center aligned">
                            <button class="ui button" onclick="supprimer({{$file->id}})"><i class="trash icon"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="ui grid stackable padded">
            <div
                class="four wide computer eight wide tablet sixteen wide mobile  center aligned column"
            >
                <div class="ui teal statistic">
                    <div class="value">
                        5,550
                    </div>
                    <div class="label">
                        Downloads
                    </div>
                </div>
            </div>
            <div
                class="four wide computer eight wide tablet sixteen wide mobile  center aligned column"
            >
                <div class="ui purple statistic">
                    <div class="value">
                        50+
                    </div>
                    <div class="label">
                        Developers
                    </div>
                </div>
            </div>
            <div
                class="four wide computer eight wide tablet sixteen wide mobile  center aligned column"
            >
                <div class="ui green statistic">
                    <div class="value">
                        800+
                    </div>
                    <div class="label">
                        Commits
                    </div>
                </div>
            </div>
            <div
                class="four wide computer eight wide tablet sixteen wide mobile  center aligned column"
            >
                <div class="ui purple statistic">
                    <div class="value">
                        1000+
                    </div>
                    <div class="label">
                        Cups of Coffee
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')
<script>
    /* Supprimer fichier */
    function supprimer(id)
    {
        var dummy = Date.now();
        $.ajax({
            url : "{{ route('delete') }}",
            type : 'get',
            dataType : 'html', // On désire recevoir du HTML
            data : {dummy:dummy, id:id}, // nombat(valeur récupéré dans maj_base : valeur)
            success : function(coderetour,statut){ // code_html contient le HTML renvoyé
                $('tr[id="'+id+'"]').remove();
                success('Le fichier a été supprimé');
            }
            ,error : function(resultat, statut, erreur){
                erreur("Le fichier n'a pas pu être supprimé");
            }
        });
    }
</script>
@endsection
