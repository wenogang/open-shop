@component('mail::message')
# Du nouveau sur OpenShop !

## Un nouveau super produit vient d'etre ajouté sur votre superbe plateforme OpenShop

Vous trouverez ci-dessous les informations sur le nouveau produit.

### Désignation: {{ $produit->designation }}

### Prix: {{ $produit->prix }}
### Categorie:{{ $produit->category->libelle }}


Pour commander ce produit clicquer juste sur le bouton ci-dessous.
@component('mail::button', ['url' => ''])
Commander ce produit
@endcomponent

Merci d'avoir choisi OpenShop pour votre shopping,<br>
{{ config('app.name') }}
@endcomponent
