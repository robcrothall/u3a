<?php
    require "../inc/header.php";
?>
    <div class="container mt-5">
        <h1>U3A Port Alfred Recordings of Presentations</h1>
        <p>These videos and (sometimes) additional information are provided in raw form, as recorded.  
        They are provided for our members who may have had to miss the presentation itself.  
        It is much better if you attend in person, because we like to see you!</p>
        <p>When you click the link to show the video recording, it will typically be displayed in low resolution by Google Drive.  
        If you would prefer a higher resolution video, click on the "Download" icon (top-left on your screen).  
        The video will download to your Downloads directory, and then if you double-click it, the video will open on your desktop.</p>
        <p>Note that downloading or watching these videos will use about 1GB of your data.</p>
        <ul>
            <li>Gillian McGregor - Aspects of the Sustainability of the Wild Honeybush Industry - 2026-07-09</li>
            <ul>
                <li><a href="https://drive.google.com/file/d/1NKnsDgJ6KGssan9fMsaqYdrCMc3iihEG/view?usp=sharing" target="_blank" 
                    class="doc-link" data-doc-name="Gillian McGregor - Aspects of the Sustainability of the Wild Honeybush Industry - 2026-07-09 Video">Video recording</a>
            </ul>
            <li>Harold Hopkins - China - 2026-06-25</li>
              <ul>
                  <li><a href="https://drive.google.com/file/d/1IPl4MJd0hwYSRz17_VxaksgMZ4fJ8GWQ/view?usp=sharing" target="_blank" 
                    class="doc-link" data-doc-name="Harold Hopkins - China - 2026-06-25 Part 1">Video recording - Part 1</a></li>
                  <li><a href="https://drive.google.com/file/d/1c9uBbCGm8wBvJHmTQBFYb33BUfppgFK9/view?usp=sharing" target="_blank" 
                    class="doc-link" data-doc-name="Harold Hopkins - China - 2026-06-25 Part 2">Video recording - Part 2</a></li>
                  <li><a href="https://drive.google.com/file/d/1kL-ksqEbU1nNuTcpohtMwrWVgPpUnhtB/view?usp=sharing" target="_blank" 
                    class="doc-link" data-doc-name="Harold Hopkins - China - 2026-06-25 Announcer article">Report on the talk by The Announcer</a></li>
                  <li><a href="https://docs.google.com/presentation/d/1Z8zGuP4KFM6a5r0PSoaETnTeZYvgw1M2/edit?usp=sharing&ouid=107558666957239851040&rtpof=true&sd=true" target="_blank" 
                    class="doc-link" data-doc-name="Harold Hopkins - China - 2026-06-25 PowerPoint">PowerPont deck</a></li>
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
