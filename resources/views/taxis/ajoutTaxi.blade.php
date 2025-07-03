<x-app-layout>
    <div class="taxi-form-container">
        <div class="container">
            <div class="form-card">
                <h1 class="form-title">
                    <i class="fas fa-taxi me-2"></i>Ajouter un nouveau taxi
                </h1>
                
                <form method="POST" action="{{ route('taxi.store') }}" enctype="multipart/form-data" class="taxi-form">
                    @csrf
                    <input type="hidden" name="chauffeur_id" value="{{ $chauffeurId }}">
                    
                    <div class="form-grid">
                        <!-- Matricule -->
                        <div class="form-group">
                            <label for="matricule">
                                <i class="fas fa-id-card-alt me-2"></i>Matricule
                            </label>
                            <input type="text" name="matricule" id="matricule" required
                                   class="form-control" placeholder="Ex: TN 1234 AB">
                            @error('matricule')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Modèle -->
                        <div class="form-group">
                            <label for="modele">
                                <i class="fas fa-car me-2"></i>Modèle
                            </label>
                            <input type="text" name="modele" id="modele" required
                                   class="form-control" placeholder="Ex: Toyota Corolla">
                            @error('modele')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Adresse -->
                        <div class="form-group">
                            <label for="adresse">
                                <i class="fas fa-map-marker-alt me-2"></i>Adresse
                            </label>
                            <input type="text" name="adresse" id="adresse" required
                                   class="form-control" placeholder="Adresse actuelle du taxi">
                            @error('adresse')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Prix par mètre -->
                        <div class="form-group">
                            <label for="prix_par_metre">
                                <i class="fas fa-money-bill-wave me-2"></i>Prix par mètre (TND)
                            </label>
                            <input type="number" step="0.01" name="prix_par_metre" id="prix_par_metre" required
                                   class="form-control" placeholder="Ex: 0.50">
                            @error('prix_par_metre')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Disponibilité -->
                        <div class="form-group">
                            <label for="disponible">
                                <i class="fas fa-check-circle me-2"></i>Disponibilité
                            </label>
                            <select name="disponible" id="disponible" class="form-control">
                                <option value="1" selected>Disponible</option>
                                <option value="0">Non disponible</option>
                            </select>
                        </div>
                        
                        <!-- Image -->
                        <div class="form-group">
                            <label for="image">
                                <i class="fas fa-camera me-2"></i>Photo du taxi
                            </label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG (max: 2MB)</small>
                            @error('image')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save me-2"></i>Enregistrer le taxi
                        </button>
                        <a href="{{ route('chauffeur.dashbord') }}" class="btn-cancel">
                            <i class="fas fa-times me-2"></i>Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <style>
        .taxi-form-container {
            padding: 40px 0;
            background-color: #f8f9fa;
            min-height: calc(100vh - 80px);
        }
        
        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            max-width: 900px;
            margin: 0 auto;
        }
        
        .form-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--accent-color);
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(58, 134, 255, 0.2);
        }
        
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn-submit {
            background: var(--accent-color);
            color: pink;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-submit:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }
        
        .btn-cancel {
            background: #6c757d;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .btn-cancel:hover {
            background: #5a6268;
            color: white;
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .form-actions {
                flex-direction: column;
            }
        }
    </style> 
    <script>
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('image-preview');
        const fileName = document.getElementById('file-name');
        
        fileName.textContent = file ? file.name : 'Sélectionner une image';
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                preview.innerHTML = `<img src="${event.target.result}" alt="Preview">`;
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    });
     </script>
</x-app-layout>