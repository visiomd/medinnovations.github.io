    <script src="https://cdn.babylonjs.com/babylon.js"></script>
    <script src="https://code.jquery.com/pep/0.4.1/pep.js"></script>
    <script src="https://preview.babylonjs.com/loaders/babylonjs.loaders.min.js"></script>

    <link rel="stylesheet" type="text/css" href="style.css">

<canvas id="renderCanvas"></canvas>

<script type = "text/javascript">
         var canvas = document.getElementById("renderCanvas");
         var engine = new BABYLON.Engine(canvas, true);
         engine.enableOfflineSupport = false;

         var createScene  = function() {
            var scene = new BABYLON.Scene(engine);

            //Adding a light
            var light = new BABYLON.PointLight("Omni", new BABYLON.Vector3(20, 20, 100), scene);

            //Adding an Arc Rotate Camera
            var camera = new BABYLON.ArcRotateCamera("Camera", 0, 0.8, 100, BABYLON.Vector3.Zero(), scene);
            camera.attachControl(canvas, false);

            var assetsManager = new BABYLON.AssetsManager(scene);
            
            var meshTask = assetsManager.addMeshTask("human", "", "/", "11.obj");

            meshTask.onSuccess = function (task) {
               task.loadedMeshes[0].position = BABYLON.Vector3.Zero();
            }	

            // Move the light with the camera
            scene.registerBeforeRender(function () {
               light.position = camera.position;
            });

            assetsManager.onFinish = function (tasks) {
               engine.runRenderLoop(function () {
                  scene.render();
               });
            };
            assetsManager.load();
            return scene;
         };
         var scene = createScene();
         engine.runRenderLoop(function() {
            scene.render();
         });
      </script>