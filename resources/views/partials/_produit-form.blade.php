@csrf
            
               <div class="form-group">
                 <label for="designation">Désignation</label>
                 <input value="{{ old('designation') ?? $produit->designation }}" type="text" name="designation" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                 @error("designation")
                 <small class="text-danger">{{ $message }}</small>
                 @enderror
                 
               </div>
               <div class="form-group">
                <label for="prix">Prix</label>
                <input value="{{ old('prix') ?? $produit->prix}}" type="number" name="prix" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                @error("prix")
                <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="categorie">Categorie</label>
                <select class="form-control" name="category_id" id="">
                    @foreach ($categories as $categorie)
                       
                    <option {{ $categorie->id == $produit->category_id ? "selected" : "" }} value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                    @endforeach
                  
                </select>
                @error("categorie")
                <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
               <div class="form-group">
                 <label for="quantite">Quantité</label>
                 <input type="number" value="{{ old('quantite') ?? $produit->quantite}}" name="quantite" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                 @error("quantite")
                 <small class="text-danger">{{ $message }}</small>
                 @enderror
                
               </div>
               <div class="form-group">
                 <label for="description">Description</label>
                 <textarea class="form-control" name="description" id="" rows="3">{{ old('description') ?? $produit->description}}</textarea>
               </div>

        <div class="form-group">
          <label for="">Image</label>
          <input type="file" class="form-control-file" name="image" id="" placeholder="" aria-describedby="fileHelpId">
          <small id="fileHelpId" class="form-text text-muted">Help text</small>
        </div>
        @error("description")
        <small class="text-danger">{{ $message }}</small>
        @enderror
        <button type="submit" name="" id="" class="btn btn-primary btn-lg btn-block">Valider</button>