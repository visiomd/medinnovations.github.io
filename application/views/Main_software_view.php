    <style type="text/css">
        .irs {
            background-image: url("images/car.jpg");
            background-repeat: no-repeat;
            
            background-size: cover;
        }
    </style>

    <div id="white" class="block irs white lighten-1">
        <div class="container">
                <h3 style="color: black" class="center">РАЗРАБОТКА </h3>
                <div class="divider"></div>
                <h5 style="text-align: center;">Анализ и проектирование процессов в сфере здравоохранения.<br> Разработка программных решений актульных для медицинской диагностики задач.</h5>
                <br>

            <div class="row">
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-stacked">
                          <div class="card-content" style=" padding-top: 5px; ">
                            <p style="text-align: justify;">
                                В нашей команде проектированием и разработкой занимаются люди специализирующиеся на информационных системах в медицине. 
                            </p>
                            <p style="text-align: justify;">
                                Основным требованием является понимания специфики диагностической деятельности для каждого члена нашей команды. 
                            </p>
                          </div>
                        </div>
                    </div>                  
                </div>
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-stacked">
                          <div class="card-content" style=" padding-top: 5px; ">
                            <p style="text-align: justify;">
                                Стек применямых нами технологий состоит из:  
                                <i> qt dev, python, pandas, openCV, scikit-learn, tensorflow и др.</i>
                            </p>  
                          </div>
                        </div>
                    </div>                  
                </div>
            </div>
            <style type="text/css">
                @media (max-width: 600px) {
                    .lincadr {
                        display: none;
                    }
                }
            </style>
            <div class="row lincadr center">
                <br>
                <div class="col s12 m3">
                    <div class="card ">
                        <div class="card-stacked">
                            <span class="card-title teal-text">Печень</span>
                          <div class="card-content" style=" padding-top: 5px; ">
                            <p></p>
                          </div>
                          <div class="card-action">
                            <a href="<?= base_url();?>Main/software#AutoLiRADS">Перейти</a>
                          </div>
                        </div>
                    </div>                  
                </div>
                <div class="col s12 m3">
                    <div class="card">
                        <div class="card-stacked">
                            <span class="card-title teal-text">Глиома</span>
                          <div class="card-content" style=" padding-top: 5px; ">
                            <p></p>
                          </div>
                          <div class="card-action">
                            <a href="<?= base_url();?>Main/software#glioma">Перейти</a>
                          </div>
                        </div>
                    </div>                  
                </div>
                <div class="col s12 m3">
                    <div class="card">
                        <div class="card-stacked">
                            <span class="card-title teal-text">Легкие</span>
                          <div class="card-content" style=" padding-top: 5px; ">
                            <p></p>
                          </div>
                          <div class="card-action">
                            <a href="<?= base_url();?>Main/software#disTuberculosis">Перейти</a>
                          </div>
                        </div>
                    </div>                  
                </div>
                <div class="col s12 m3">
                    <div class="card">
                        <div class="card-stacked">
                            <span class="card-title teal-text">Синтез КТ</span>
                          <div class="card-content" style=" padding-top: 5px; ">
                            <p></p>
                          </div>
                          <div class="card-action">
                            <a href="<?= base_url();?>Main/software#syntheticCT">Перейти</a>
                          </div>
                        </div>
                    </div>                  
                </div>
            </div>
            
        </div>
    </div>
    
    <div id="black" class="block black lighten-1">
        <nav class="pushpin-demo-nav pin-top" data-target="black" style="top: 0px;">
            <div class="nav-wrapper black">
                <div class="container">
                    <a href="" class="brand-logo">AutoLiRADS</a><a name="AutoLiRADS"></a>

                </div>
            </div>
        </nav>
        <div class="container white-text">
            <div class="row" style="padding-top: 30px;">
                <div class="col s8 m8 l8 white-text">
                    <p></p>
                    <p style="text-align: justify;">
                        Программа AutoLi-RADS предназначена для автоматической оценки, классификации и описании патологий печени по КТ - изображениям, согласно международным рекомендациям по системе оценки <a href="https://www.acr.org/-/media/ACR/Files/RADS/LI-RADS/LI-RADS-2018-Core.pdf?la=en" target="_blank"> Li-RADS</a>.
                    </p>
                    <p style="text-align: justify;">
                        Единообразие выполнения процесса  оценки с использованием программы AutoLi-RADS позволит объективно сравнивать результаты исследований и стандартизировать отчетность врача-рентгенолога.
                    </p>
                </div>
                <dir class="col s4 m4 l4 amber darken-4 center">
                    <img src="<?= base_url();?>assets/img/LIRADS.png">
                </dir>
            </div>
            <dir class="row">
                <h5>Функции продукта: программа AutoLi-RADS</h5>
                <dir class="col s4 m4 l4">
                    <p>
                        <strong class="amber-text" style="font-size: 1.5em">1</strong>
                        работа с пакетами DICOM
                    </p>
                </dir>
                <dir class="col s4 m4 l4">
                    <p>
                        <strong class="amber-text" style="font-size: 1.5em">2</strong>
                        интерфейс для просмотра DICOM изображений
                    </p>
                </dir>
                <dir class="col s4 m4 l4">
                    <p>
                        <strong class="amber-text" style="font-size: 1.5em">3</strong>
                        маркировка образований на изображениях
                    </p>
                </dir>
                <dir class="col s12 m12 l12 amber darken-4 center">
                    <h4>Auto-Li-RADS</h4>
                </dir>
                <dir class="col s4 m4 l4">
                    <p>
                        <strong class="amber-text" style="font-size: 1.5em">4</strong>
                        извлечение характеристик образований согласно рекомендациям Li-RADS 
                    </p>
                </dir>
                <dir class="col s4 m4 l4">
                    <p>
                        <strong class="amber-text" style="font-size: 1.5em">5</strong>
                        оценка образований в соответствии с Li-RADS
                    </p>
                </dir>
                <dir class="col s4 m4 l4">
                    <p>
                        <strong class="amber-text" style="font-size: 1.5em">6</strong>
                        автоматическая генерация отчета *.docx, *.pdf 
                    </p>
                </dir>
            </dir>
            <div class="row center">
                <a class="btn amber darken-4 waves-effect waves-light" href="<?= base_url();?>assets/pdf/AutoLi-Rads презентация продукта.pdf">см. Презентацию</a>
            </div>

        </div>
    </div>

    <div id="yellow" class="block yellow lighten-1">
        <nav class="pushpin-demo-nav pin-top" data-target="yellow" style="top: 0px;">
            <div class="nav-wrapper yellow">
                <div class="container">
                    <a href="" name= "glioma" class="brand-logo">Glioma Project</a>
                </div>
            </div>
        </nav>
        <div class="container white-text">
            <div class="row center">
                <div class="col s12 m12 l12">
                    <h3 class="light grey-text">РАЗМЕТКА И ОПРЕДЕЛЕНИЕ КЛАССИФИКАЦИОННОГО ТИПА ГЛИОМЫ ГОЛОВНОГО МОЗГА НА МРТ ИЗОБРАЖЕНИЯХ</h3>
                </div>
            </div>
            <div class="row" style="padding-top: 30px;">
                <div class="col s8 m8 l8 white-text">
                    <img src="<?= base_url();?>assets/img/Glioma.gif" style="width: 100%">
                </div>
                <dir class="col s4 m4 l4 black-text">
                    <h5>Решаемые задачи:</h5>
                    <p style="text-align: justify;">выставление границ глиомы с учетом ее классификационного типа.</p>
                    <p style="text-align: justify;">
                        определение классификационного типа глиомы головного мозга на МРТ изображениях на основе дополнительных признаков внутренней гетерогенной структуры опухоли. 
                    </p>
                </dir>
            </div>
            <div class="row center">
                <div class="col s12 m12 l12" style="width: 150px">
                </div>
            </div>

        </div>
    </div>

    <div id="blue" class="block blue lighten-1">
        <nav class="pushpin-demo-nav pin-top" data-target="blue" style="top: 0px;">
            <div class="nav-wrapper blue">
                <div class="container">
                    <a href="" name="syntheticCT" class="brand-logo">syntheticCT</a>

                </div>
            </div>
        </nav>
        <div class="container white-text">

            <div class="row center">
                <div class="col s12 m12 l12">
                    <h3 class="light">СИНТЕЗ ЗНАЧЕНИЙ ХАУНСФИЛДА ПО ДАННЫМ МРТ</h3>
                </div>
            </div>
            <div class="row center">
                <div class="col s8 m8 l8 white-text">
                    <div class="row center">
                        <div class="col s6 m6 l6 white-text">
                            <h5>Стандартный подход</h5>
                        </div>
                        <div class="col s6 m6 l6 white-text">
                            <h5>Предлагаемое решение</h5>
                        </div>
                        <div class="col s6 m6 l6 white-text">
                            <img class="materialboxed" src="<?= base_url();?>assets/img/S1.png" style="width: 80%">
                        </div>
                        <div class="col s6 m6 l6 white-text">
                            <img class="materialboxed" src="<?= base_url();?>assets/img/S2.png" style="width: 80%">
                        </div>
                    </div>
                    <div class="row center">
                        <div class="col s8 m8 l8 center" style="width: 150px">
                            <img src="<?= base_url();?>assets/img/ezgif.gif">
                        </div>
                    </div>
                </div>
                <div class="col s4 m4 l4 white-text">
                    <h5>Глобальная цель</h5>
                    <p>Предоставить инструмент по извлечению большего числа диагностических признаков при диагностике МРТ исследований.</p>

                    <p>Информационная система направлена на получение новых диагностических признаков при работе с МРТ
                    изображениями, на основе синтеза значений (диагностических признаков, отражающих изменение электронной плотности), нормированных по шкале Хаунсфилда, используя только данные МРТ.</p>
                    <a class="btn blue darken-4 waves-effect waves-light" href="<?= base_url();?>assets/pdf/GenerationXUnitsByMri.pdf">см. Презентацию</a>
                    
                </div>
            </div>



        </div>
    </div>

    <div id="green" class="block green lighten-1">
        <nav class="pushpin-demo-nav pin-top" data-target="green" style="top: 0px;">
            <div class="nav-wrapper green">
                <div class="container">
                    <a href="" name="disTuberculosis" class="brand-logo">Volume disTuberculosis</a>

                </div>
            </div>
        </nav>
        <div class="container white-text center">
            <h5>Раздел в разработке</h5>
        </div>
    </div>