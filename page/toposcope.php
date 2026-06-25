<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toposcope Journal</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/w3.css">
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">Lower Albany Historical Society (w1 - php 1)</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" aria-current="page" href="https://lahs.co.za/w1/index.php">Home</a></li>
            <!-- <li class="nav-item"><a class="nav-link" href="https://lahs.co.za/index.php#about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="https://lahs.co.za/index.php#events">Events</a></li>
            <li class="nav-item"><a class="nav-link" href="https://lahs.co.za/index.php#membership">Membership</a></li>
            <li class="nav-item"><a class="nav-link active" href="https://lahs.co.za/app/page/toposcope.php">Toposcope</a></li>
            <li class="nav-item"><a class="nav-link" href="https://lahs.co.za/index.php#contact">Contact</a></li> -->
          </ul>
        </div>
      </div>
    </header>
    <div class="container mt-5">
        <h1>Toposcope Journal</h1>
        
        <ul>
            <li>Toposcope Journal - April 18, 2026</li>
            <ul>
                <li><a href="../../public/docs/LAHS_Toposcope_Online_and_Newsletters_20260418.pdf" target="_blank" 
                class="doc-link"
                data-doc-name="LAHS_Toposcope_Online_and_Newsletters_20260418.pdf">Editorial</a></li>
                <li><a href="../../public/docs/LAHS_Toposcope_Online_and_Newsletters_20260418.pdf" target="_blank" 
                class="doc-link" 
                data-doc-name="LAHS_Toposcope_Online_and_Newsletters_20260418.pdf">Joe Soap: Cow racing in Bathurst</a></li>
            </ul>
            <li>Toposcope Journal - March 18, 2026</li>
            <ul>
                <li><a href="../../public/docs/LAHS_Toposcope_Online_and_Newsletters_20260418.pdf" target="_blank" 
                class="doc-link"
                data-doc-name="LAHS_Toposcope_Online_and_Newsletters_20260418.pdf">Editorial</a></li>
                <li><a href="../../public/docs/LAHS_Toposcope_Online_and_Newsletters_20260318.pdf" target="_blank" 
                class="doc-link" 
                data-doc-name="LAHS_Toposcope_Online_and_Newsletters_20260318.pdf">Jim Fish: The Turin Shroud Controversy</a></li>
            </ul>
        </ul>
    </div>

    <script src="../../public/js/bootstrap.bundle.min.js"></script>
    <script>
        // Log document access when links are clicked
        document.querySelectorAll('.doc-link').forEach(link => {
            link.addEventListener('click', function(e) {
                const docName = this.getAttribute('data-doc-name');
                
                // Log the access
                fetch('/w1/page/log_document_access.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        doc_name: docName
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Document access logged:', data);
                })
                .catch(error => {
                    console.error('Error logging document access:', error);
                });
                
                // Allow the link to proceed
                // The target="_blank" will handle opening in new tab
            });
        });
    </script>
</body>
</html>
