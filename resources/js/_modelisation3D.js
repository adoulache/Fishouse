let scene, cameraPersp, renderer, cameraOrtho, currentCamera, width, canvas; 
let startColor, orbitControls, stats, transformControls, objects = [], currentObject;

init();
render();

/* Fonction pour initialiser la scène 
* Création de la scène + récupération des éléments déjà placés dans la zone de modélisation. 
*/
function init() {

    var container = document.getElementById('container');

    var containerWidth = container.clientWidth - 20;
    var containerHeight = container.clientHeight;

    const aspect = containerWidth / containerHeight;

    // Initialisation du renderer
    renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize( containerWidth, containerHeight );

    canvas = renderer.domElement;
    container.appendChild(canvas);

    // Initialisation des caméras
    cameraPersp = new THREE.PerspectiveCamera(75, aspect, 0.01, 10000 );
    cameraOrtho = new THREE.OrthographicCamera(-600 * aspect, 600 * aspect, 600, - 600, 0.01, 10000);
    currentCamera = cameraPersp; 

    // Création de la scène 
    scene = new THREE.Scene();
    scene.background = new THREE.Color( 0xf0f0f0 );
    scene.add( new THREE.GridHelper(1000, 10, 0x8888888, 0x4444444));

    // Position de la caméra (en fonction des paramètres de la caméra)
    currentCamera.position.z = 1000;
    
    //Lumières permettant de voir les éléments présents sur la scène
    scene.add( new THREE.AmbientLight( 0x0f0f0f ) );
    // Eclairer devant 
    var light = new THREE.SpotLight( 0xffffff, 1.5 );
    light.position.set( 0, 500, 2000 );
    light.target.updateMatrixWorld();
    scene.add(light);

    // Eclairer derrière
    var light = new THREE.SpotLight( 0xffffff, 1.5 );
    light.position.set( 0, -500, -2000 );
    light.target.updateMatrixWorld();
    scene.add(light);


    // Contrôle de la scène
    orbitControls = new THREE.OrbitControls( currentCamera, canvas );
    orbitControls.update();
    orbitControls.addEventListener('change', render);


    var controls = new THREE.DragControls( objects, currentCamera, canvas );
    container.appendChild(canvas);
    controls.addEventListener( 'dragstart', dragStartCallback );
    // controls.addEventListener( 'dragend', dragendCallback );


    // Adapter la scène selon la taille de l'écran
    window.addEventListener('resize', onWindowResize);

    // Permet différentes actions quand on veut manipuler un objet : comme la rotation en appuyan sur "e"
    window.addEventListener('keydown', keydown);

    
}

// Correspond aux différentes actions possibles sur l'objet 
function keydown(event){
    switch(event.key){
        case "w": // Activer les axes de positionnement de l'objet 
            transformControls.setMode("translate");
            break;
        case "e": // Activer les axes de rotation de l'objet 
            transformControls.setMode("rotate");
            break;
        case "r": // Activer les axes pour changer la taille de l'objet 
            transformControls.setMode("scale");
            break;
        case "c": // Changer de caméra et par conséquent, changer de vue
            const position = currentCamera.position.clone();
            currentCamera = currentCamera.isPerspectiveCamera ? cameraOrtho : cameraPersp;
            currentCamera.position.copy(position);
            orbitControls.object = currentCamera;
            transformControls.camera = currentCamera;
            currentCamera.lookAt(orbitControls.target.x, orbitControls.target.y, orbitControls.target.z);
            onWindowResize();
            break;
        case "=": // Augmenter la taille des axes 
            transformControls.setSize(transformControls.size + 0.1);
            break;
        case "-": // Diminuer la tailler des axes 
            transformControls.setSize(Math.max(transformControls.size - 0.1, 0.1));
            break;
        case "x": // Cacher l'axe x
            transformControls.showX = !transformControls.showX;
            break;
        case "y": // Cacher l'axe y
            transformControls.showY = !transformControls.showY;
            break;
        case "z": // Cacher l'axe z 
            transformControls.showZ = !transformControls.showZ;
            break;
        case " ": // Activer ou désactiver le contrôle
            transformControls.enabled = !transformControls.enabled;
            break;
        case "d": //Supprimer l'objet
            deleteObject();
    }
}

/*AJOUT D'UN OBJET */
$(function(){
    $('.btnAjoutObjet').on('click', function(){

        var nomObjet = $(this).attr('id');
        var obj;

        if (nomObjet == "Aquarium_Castle"){
            obj = objectScene('./object/Aquarium_Castle/Aquarium_Castle.mtl','./object/Aquarium_Castle/Aquarium_Castle.obj', scene, objects);

        } else {
            obj = objectScene('./object/Aquarium_Deep_Sea_Diver_v1_L1.123c12f9d350-3d3e-4e72-a6f1-47d702f1dcd0/Aquarium_Deep_Sea_Diver.mtl',
            './object/Aquarium_Deep_Sea_Diver_v1_L1.123c12f9d350-3d3e-4e72-a6f1-47d702f1dcd0/Aquarium_Deep_Sea_Diver.obj', scene, objects);
        };

        console.log('obj',obj);
        var idProjet = $('#idProjet3D').val();
        console.log(idProjet );

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : 'modelisation3D3',
            type : 'POST',
            data : 'idProjet=' + idProjet + '&nomObjet=' + nomObjet,
            async : false,
            success : function(data){
                console.log("SUCCES dans l'insert de la table temporaire déco");
            },
            error : function(error){
                console.log("ERROR dans l'insert de la table temporaire déco");
                console.log(error);
            }
        });

    });

});

function objectScene(pathMTL,pathOBJ, scene, objects, 
                    scaleX = 15, scaleY = 15, scaleZ = 15,
                    positionX = 1, positionY = 1, positionZ = 1)
{
    const mtlLoader = new THREE.MTLLoader();
    const objLoader = new THREE.OBJLoader();
    mtlLoader.load(pathMTL, (mtl) => {
        mtl.preload();
        objLoader.setMaterials(mtl);
        objLoader.load(pathOBJ, (root) => {
            // Position aléatoire 
            root.position.x = positionX;
            root.position.y = positionY;
            root.position.z = positionZ;

            // Taille 
            root.scale.set(scaleX,scaleY,scaleZ);

            // Rotation 
            root.rotation.x = root.rotation.x - 1.57; //mesure en radian pour mettre l'object 3D perpandiculaire à la grille (besoin d'enlever 90°, soit 1.57 radian)

            //console.log('root.rotation.x', root.rotation.x);
            //console.log('root.rotation.y', root.rotation.y);
            //console.log('root.rotation.z', root.rotation.z);

            scene.add(root);
            objects.push(root);
            return root;
        });
    });
    
}

/*SUPPRESSION D'UN OBJET*/
function deleteObject(){
    var selectedObject = currentObject;
    transformControls.detach(currentObject);
    selectedObject.parent.remove( selectedObject );
    
    // var idObjet;

    // if(currentObject.name === "13020_Aquarium_Castle"){
    //     idObjet = 1;
    // }else{
    //     idObjet = 2;
    // }

    // var idProjet = 0;// ???

    // $(function(){
    //     $.ajaxSetup({
    //         headers:{
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         url : 'modelisation3D4',
    //         type : 'POST',
    //         data : 'idProjet=' + idProjet + '&idObjet=' + idObjet,
    //         async : false,
    //         success : function(data){
    //             console.log("SUCCES dans la suppresion de la déco");
    //         },
    //         error : function(error){
    //             console.log("ERROR dans la suppresion de la déco");
    //             console.log(error);
    //         }
    //     });
    // });
}

/*SUPPRESSION D'UN PROJET */
$(function(){
    $('.btnOnglet3D').on('click', function(){
        let id = $(this).attr('id');
        recupObjets3D(id);
    });
});

/* Récupère les objets présents dans l'aquarium depuis la base de données */
function recupObjets3D(idProjet) {
    /* PLANTES */
    //console.log(idProjet);
    // var retour = $.ajax({
    //     url: 'modelisation3D4',
    //     type: 'GET',
    //     data: 'idProjet=' + idProjet,
    //     async: false,
    //     dataType: 'JSON',
    //     success: function (data) {
    //         console.log('success getPlantes');
    //     },
    //     error: function (text) {
    //         console.log('error getPlantes');
    //     }
    // });
    // var reponsePlante = JSON.parse(retour.responseText);
    // var plantesAquarium = [];
    // if (reponsePlante.plantes.length > 0) {
    //     reponsePlante.plantes.forEach((item) => {
    //         /* Récupération du chemin de la plante */
    //         var retourChemin = $.ajax({
    //             url: 'modelisation3D6',
    //             type: 'GET',
    //             data: 'idPlante=' + item.id_plante,
    //             async: false,
    //             dataType: 'JSON',
    //             success: function (data) {
    //                 console.log('success getCheminPlantes');
    //             },
    //             error: function (text) {
    //                 console.log('error getCheminPlantes');
    //             }
    //         });
    //         var parseChemin = JSON.parse(retourChemin.responseText);
    //         plantesAquarium.push([item.coordx, item.coordy, item.coordz, parseChemin.chemin, item.id_unique]);
    //     });
    // }
    // ;

    /* DECORATIONS */
    console.log("idProjet : " + idProjet);
    var retourDeco = $.ajax({
        url: 'modelisation3D5',
        type: 'GET',
        data: 'idProjet=' + idProjet,
        async: false,
        dataType: 'JSON',
        success: function (data) {
            console.log('success getDecos3D');
        },
        error: function (text) {
            console.log('error getDecos3D');
        }
    });
    var reponseDeco = JSON.parse(retourDeco.responseText);
    //console.log(reponseDeco);
    
    if (reponseDeco != null) {
        reponseDeco.forEach((item) => {
            /* Récupération du chemin de la décoration */
            var retourCheminDeco = $.ajax({
                url: 'modelisation3D7',
                type: 'GET',
                data: 'idDeco=' + item.id_decoration3d,
                async: false,
                dataType: 'JSON',
                success: function (data) {
                    console.log('success getCheminDeco3D');
                },
                error: function (text) {
                    console.log('error getCheminDeco3D');
                }
            });
            var parseCheminDeco = JSON.parse(retourCheminDeco.responseText);
            console.log(parseCheminDeco);
            
            if (parseCheminDeco.chemin3D == "Aquarium_Castle"){
                objectScene('./object/Aquarium_Castle/Aquarium_Castle.mtl','./object/Aquarium_Castle/Aquarium_Castle.obj', scene, objects);
        
            } else {
                objectScene('./object/Aquarium_Deep_Sea_Diver_v1_L1.123c12f9d350-3d3e-4e72-a6f1-47d702f1dcd0/Aquarium_Deep_Sea_Diver.mtl',
                './object/Aquarium_Deep_Sea_Diver_v1_L1.123c12f9d350-3d3e-4e72-a6f1-47d702f1dcd0/Aquarium_Deep_Sea_Diver.obj', scene, objects);
            };
        });
    };
};


// Fonction qui permet d'adapter la scene selon la taille de la fenêtre sans devoir tout raffraîchir (et garder les éléments au milieu)
function onWindowResize() {
    containerWidth = container.clientWidth - 20;
    containerHeight = container.clientHeight;
    const aspect = containerWidth / containerHeight;

    cameraPersp.aspect = aspect;
    cameraPersp.updateProjectionMatrix();

    cameraOrtho.left = cameraOrtho.bottom * aspect;
    cameraOrtho.right = cameraOrtho.top * aspect;
    cameraOrtho.updateProjectionMatrix();

    renderer.setSize( containerWidth, containerHeight );
    render();
}

// Fonctions pour ajouter la possibilité de bouger les éléments quand on clique sur l'objet (via le transformControls)
function dragStartCallback(event) {
    transformControls = new THREE.TransformControls(currentCamera, canvas);
    transformControls.addEventListener('change', render);
    transformControls.addEventListener('dragging-changed', function(event){
        orbitControls.enabled = ! event.value;
    });
    
    transformControls.attach(event.object);
    scene.add(transformControls);

    currentObject = event.object;
}

// Fonctions de base pour l'animation 
function animate() {
    requestAnimationFrame( animate );
    orbitControls.update(); 
    render();
};

function render(){
    renderer.render(scene, currentCamera);
}