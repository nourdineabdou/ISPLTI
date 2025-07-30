@extends('layouts_site.main')
@section('content')
    <div class="container mt-5">
        <h2>Comptes Extracted from File</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Agence</th>
                    <th>Compte</th>
                    <th>Clé</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $row)
                    <tr>
                        <td>{{ $row['agence'] }}</td>
                        <td>{{ $row['compte'] }}</td>
                        <td>{{ $row['cle'] }}</td>
                        <td>{{ $row['montant'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
