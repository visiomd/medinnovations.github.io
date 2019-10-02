        <div class="slider">
            <ul class="slides">
                <li>
                    <img src="<?= base_url();?>assets/img/MesidWork3.jpg">
                    <!-- random image -->
                    <div class="caption center-align CenterHead1">
                        <h4>Разметка изображений и сбор метрик</h4>
                        <p class="light grey-text text-lighten-3">Решение узкоспециализированных и трудоемких задач: картирование, сбор метрик, оценка, классификация. Сочетание умений и знаний врача и результатов работы МЭСИД позволяет упростить решение рутинных, сложных задач и добиться большей точности при диагностике.</p>
                    </div>
                </li>
                <li>
                    <img src="<?= base_url();?>assets/img/MesidWork1.jpg">
                    <!-- random image -->
                    <div class="caption left-align leftHead">
                        <h4>Генерация отчета с экспертным рентгенолическим заключением</h4>

                        <p class="light grey-text text-lighten-3">• Выполняется компьютерная обработка данных КТ/МРТ/ПЭТ-исследований* с помощью технологии интеллектуальной диагностики и формируется отчет о результатах</p>

                        <p class="light grey-text text-lighten-3">• Проводится экспертная оценка результатов обработки врачами-рентгенологами с представлением рентгенологического заключения</p>

                        <h5 class="light grey-text text-lighten-3"></h5>
                    </div>
                </li>
                <li>
                    <img src="<?= base_url();?>assets/img/MesidWork4.jpg">
                    <!-- random image -->
                    <div class="caption right-align rightHead">
                        <h3>Реконструкция 3D моделей</h3>
                        <p class="light grey-text text-lighten-3">Сегментация и выполнение реконструкции 3D моделей позволяет проводить врачу детальный осмотр зоны интереса с целью анализа ее геометрических параметров, расположения относительно других органов, выявления аномалий и отклонений строения.</p>
                    </div>
                </li>
                <li>
                    <img src="<?= base_url();?>assets/img/MesidWork2.jpg">
                    <!-- random image -->
                    <div class="caption center-align CenterHead">
                        <h3>Дифференцировка диагноза</h3>
                        <p class="light grey-text text-lighten-3">Проводится исключение из группы наиболее маловероятных предположений путем комбинирования рентгенологических и клинических признаков. Просчитываются варианты сразу по нескольким методикам используя разные шкалы и классификаторы, подбираются наиболее схожие по комбинаторике результаты</p>
                    </div>
                </li>
            </ul>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.slider').slider({
                    full_width: true,
                    indicators: true,
                    height: 550, // default - height : 400
                    interval: 8000 // default - interval: 6000
                });
            });
        </script>

        <br>
        <center>
            <a class='dropdown-button btn' href='#' data-activates='dropdown1'>Начать</a>
        </center>

        <!-- Modal Обратная связь -->
        <div id="modal1" class="modal">
            <form action="mailto:medinnovations@mail.ru" method="post" enctype="text/plain">
                <div class="modal-content">
                    <h4>Обратная связь</h4>
                    <p>Заполните, пожалуйста, форму, кратко рассказав о ваших задачах и научных интересах.</p>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="comp_name" type="text" class="validate">
                            <label for="comp_name">Название компании</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="last_name" type="text" class="validate">
                            <label for="last_name">Контактное лицо</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input disabled value="Сотрудничество" id="disabled" type="text" class="validate">
                            <label for="disabled">Тема обращения</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="textarea1" class="materialize-textarea"></textarea>
                            <label for="textarea1">Текст обращения</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate">
                            <label for="email">Email для обратной связи</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">
                        <input type="submit" value="Отправить">
                    </a>
                </div>
            </form>
        </div>