<h2> {mes | uppercase} </h2>
<div>

    <aside>
        <bp-nav-meses></bp-nav-meses>
    </aside>
    <article class="meses">

        <header>
            <h4>{{mes}}</h4>
        </header>

        <ul id="dias_del_mes_movil">

            <li>
                
                <ul id="dias_de_un_mes">
                    <li id="ant_ejercicio">Ant.</li>
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                    <li>7</li>
                    <li>8</li>
                    <li>9</li>
                    <li>10</li>
                    <li>11</li>
                    <li>12</li>
                    <li id="sig_ejercicio">Sig.</li>
                </ul>

            </li>

            <li>

                <ul>

                    <li class="ocultar resaltado">

                        <div >Concepto</div>
                        <div class="alinear_centro">Precio/Unidad</div>
                        <div class="alinear_centro">Cantidad</div>
                        <div class="alinear_derecha">Total</div>

                    </li>

                    <li class="ocultar">

                        <form action="http://algunsitio.com/prog/usuarionuevo" method="post">
                              <input type="text" id="nombre" />
                            <input type="text" id="apellido" />
                            <input type="text" id="email" />
                            <input type="submit" id="enviar" />
                         </form>

                    </li>

                    <li>

                        <div>Factura electrica</div>
                        <div class="ocultar alinear_centro">40€</div>
                        <div class="ocultar alinear_centro">1</div>
                        <div class="alinear_derecha">80€</div>

                    </li>

                    <li>

                        <div>Alquiler mes</div>
                        <div class="ocultar alinear_centro">500€</div>
                        <div class="ocultar alinear_centro">1</div>
                        <div class="alinear_derecha">500€</div>

                    </li>

                    <li class="total_dia">

                        <div >Total</div>
                        <div class="alinear_derecha">580€</div>

                    </li>

                </ul>
            </li>

        </ul>

        <footer class="pie_mes">
            <menu>
                <ul><!-- mostrar a partir de -->
                    <li><a href="#"><img />BALANCE</a></li>
                    <li><a href="#"><img />P y G</a></li>
                    <li><a href="#"><img />TESORERIA</a></li>
                </ul>
            </menu>
        </footer>
    </article>

</div>
