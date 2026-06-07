</div> </main> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btnMenu = document.getElementById('btnMenu');
            const sidebar = document.querySelector('.sidebar');

            if (btnMenu) {
                btnMenu.addEventListener('click', function() {
    
                    sidebar.classList.toggle('mostrar');
                });
            }
        });
    </script>
</body>
</html>