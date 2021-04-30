
            <table class="table">
                <thead>
                    <tr>
                        <th>Désignation</th>
                        <th>Prix</th>
                        <th>quantite</th>
                        <th>desciption</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($produits as $produit)
                    
                    <tr>
                        <td scope="row">{{ $produit->designation }}</td>
                        <td>{{ separateur_fcfa($produit->prix) }}</td>
                        <td>{{ $produit->quantite }}</td>
                        <td>{{ $produit->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>