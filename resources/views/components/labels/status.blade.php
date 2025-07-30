@php
/*
 * En attente
En cours
Terminé
Annulé
Payé
Moitié payé
Remboursé
 * */
    $classes = [
        'paid' => 'badge bg-success',
        'unpaid' => 'badge bg-danger',
        "pending" => 'badge bg-warning',
        'delivered' => 'badge bg-success',
        'not_delivered' => 'badge bg-danger',
        'processing' => 'badge bg-info',
        'completed' => 'badge bg-success',
        'canceled' => 'badge bg-danger',
        'refunded' => 'badge bg-danger',
        'failed' => 'badge bg-danger',
        'expired' => 'badge bg-danger',
        'active' => 'badge bg-success',
        'inactive' => 'badge bg-danger',
        'suspended' => 'badge bg-danger',
        'blocked' => 'badge bg-danger',
        'verified' => 'badge bg-success',
        'unverified' => 'badge bg-danger',
        'published' => 'badge bg-success',
        'unpublished' => 'badge bg-danger',


        'En attente' => 'badge bg-warning',
        'En cours' => 'badge bg-info',
        'Terminé' => 'badge bg-success',
        'Annulé' => 'badge bg-danger',
        'Payé' => 'badge bg-success',
        'Moitié payé' => 'badge bg-info',
        'Remboursé' => 'badge bg-danger',

        'active' => 'badge bg-success',
        'inactive' => 'badge bg-danger',
        'suspended' => 'badge bg-danger',

    ];
@endphp

<span class="{{ $classes[$status] ?? 'badge bg-secondary' }}">
    {{ ucfirst($status) }}
</span>
