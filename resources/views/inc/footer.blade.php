        <!--Modal para as confirmacoes de exclusao-->
        <div id="modal-default" class="modal">
            <div class="modal-content">
                <h2 class="title"></h2>
                <div class="divider"></div>
                <p class="text"></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="confirmar" class="modal-action modal-close btn waves-effect waves-light">Ok</a>
                <button type="button" class="modal-action modal-close btn waves-effect waves-light">Fechar</a>
            </div>
        </div>

        <footer>
            <a href="#">Contato</a>
            <a href="#">Sobre o InsideTv</a>
            <a href="#">Termos de uso</a>
            <p>2016 InsideTv - Todos os direitos reservados</p>
        </footer>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
        <script src="{{ asset('js/global.js') }}"></script>
        <script>
            $(document).ready(function(){
                $('.modal').modal({
                    endingTop: '50%',
                });
          });
        </script>

        @yield('scripts')
    </body>
</html>
