<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publications - Shahriar Khan</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .page-title {
            font-family: 'Poppins', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .page-subtitle {
            font-size: 1.2rem;
            font-weight: 300;
            opacity: 0.95;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
        }
        
        .publications-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .publication-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        
        .publication-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(102, 126, 234, 0.15);
        }
        
        .publication-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
        }
        
        .no-image-placeholder {
            width: 100%;
            height: 240px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .no-image-placeholder i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.7;
        }
        
        .publication-content {
            padding: 1.5rem;
            flex-grow: 1;
        }
        
        .publication-text {
            color: #4a5568;
            line-height: 1.7;
            font-size: 0.95rem;
        }
        
        .publication-id {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }
        
        .empty-icon {
            font-size: 5rem;
            color: #cbd5e0;
            margin-bottom: 1.5rem;
        }
        
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: white;
            color: #667eea;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-top: 1rem;
        }
        
        .back-button:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .publications-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Page Header -->
    <header class="page-header">
        <div style="max-width: 1200px; margin: 0 auto;">
            <h1 class="page-title">
                <i class="bi bi-book-half"></i> Publications
            </h1>
            <p class="page-subtitle">Explore our collection of publications and summaries</p>
            <div style="margin-top: 1.5rem;">
                <a href="/" class="back-button">
                    <i class="bi bi-house-door"></i> Back to Home
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        @if($publications->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-inbox"></i>
                </div>
                <h2 style="font-size: 1.75rem; font-weight: 600; color: #2d3748; margin-bottom: 0.75rem;">
                    No Publications Yet
                </h2>
                <p style="font-size: 1.1rem; color: #718096;">
                    Check back later for new publications
                </p>
            </div>
        @else
            <div class="publications-grid">
                @foreach($publications as $publication)
                    <div class="publication-card">
                        @if($publication->hasMedia('publication_images'))
                            <img src="{{ $publication->getFirstMediaUrl('publication_images') }}" 
                                 alt="Publication Image" 
                                 class="publication-image">
                        @else
                            <div class="no-image-placeholder">
                                <i class="bi bi-image"></i>
                                <p>No Image Available</p>
                            </div>
                        @endif

                        <div class="publication-content">
                            <span class="publication-id">ID: {{ $publication->id }}</span>
                            <p class="publication-text">{{ $publication->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
