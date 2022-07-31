![](https://iccti.chaco.gob.ar/wp-content/uploads/2022/01/logoh.png)

### Requerimientos

HTTP Server. Por ejemplo: Apache. mod_rewrite es aconsejable que este habilitado, pero no es obligatorio. Puede usar nginx, o Microsoft IIS si lo prefiere.

- Mínimo PHP 7.4 (8.1 supported).
- Extensión mbstring PHP
- Extensión intl PHP
- Extensión SimpleXML PHP
- Extensión PDO PHP
- MySQL (5.6 or higher)
- MariaDB (5.6 or higher)

# Instalación
Usamos el comando git desde consola, y en este ejemplo pondremos iccti como nombre del directorio: git clone [https://github.com/pekarnick/ICCTI-DOCS.git] NOMBRE_DEL_DIRECTORIO

`$ git clone https://github.com/pekarnick/ICCTI-DOCS.git iccti`

Ahora utilizaremos el la utilidad composer para actualizar las dependencias
[(Desde aqui puede acceder al proyecto para ver como instalarlo)](https://getcomposer.org/download/ "(Desde aqui puede acceder al proyecto para ver como instalarlo)")

`$ cd iccti`

`$ composer update`

#Instalar la base de datos

La base de datos, segun nuestro ejemplo, se encuentra en:

/iccti/base_de_datos.sql

Importar la base de datos

Luego de importar configurar la conexión

En mi caso los datos para configurar la conexión son los siguientes

Base de datos: c3_icctidb
Usuario de la base de datos: c3_iccti
Contraseña: ictti2022

Copiar el archivo de configuración local:

`$ cp config/app_local.example.php config/app_local.php`
Editar el archivo y escribir los datos de nuestra conexión
`$ nano config/app_local.php`

Modificar:
  * 
            'username' => 'dbuser',
            'password' => 'dbpassword',
            'database' => 'dbname',
 
Debe quedar:
 * 
            'username' => 'c3_iccti',
            'password' => 'ictti2022',
            'database' => 'c3_icctidb',
 

Y ya que estamos en este archivo tambien modificar el servidor smtp para enviar los correos de las confirmaciones, en nuestro caso usamos sendinblue


    EmailTransport' => [
            // Configuracion para usar con sendinblue
            'default' => [
                'host' => 'smtp-relay.sendinblue.com',
                'port' => 587,
                'username' => 'icctitest@gmail.com',
                'password' => 'password',
                'className' => 'Smtp',
    //            'tls' => true
            ],
        ],

Y cambiamos los datos por los siministrados al registrarse en sendinblue, usar este servicio evita que los correos terminen en la bandeja de spam.

#Permisos de directorios
Vamos a dar permisos de escritura a ciertos directorios:

`$ chmod -Rv 777 tmp/`

`$ chmod -Rv 777 webroot/files/`

#Configurar rutas y correos
Ahora tenemos que configurar las direcciones de correo y nombre del servidor

1. Vamos a:
`$ nano src/Controller/PostulantesController.php`
Cambiar el valor de los atributos "mail" "mailadmin" y "servidor" por los suyos:
    

        //Setear los correos y nombres de host para el mensaje
        public $mail = "icctitest@gmail.com";
        public $mailadmin = "financiamientoiccti@gmail.com";
        public $servidor = "https://iccti.chaco.gob.ar/regs/fontech";


Guardamos y vamos al siguiente:

`$ nano src/Controller/Admin/PostulantesController.php `

Y realizar las mismas modificaciones que en el archivo anterior


    //Setear los correos y nombres de host para el mensaje
        public $mail = "icctitest@gmail.com";
        public $mailadmin = "financiamientoiccti@gmail.com";
        public $servidor = "https://iccti.chaco.gob.ar/regs/fontech";

Y listo ya podemos acceder al administrador desde

https://susitioweb.com/iccti/users/login

Usuario: admin

Contraseña: admin

Puede cambiar la contraseña desde:

https://susitioweb.com/iccti/users

Busca su usuario y presiona el boton "Editar"

#Conclusión
Los usuarios acceden desde el mismo login, pruebe crear un usuario y comience a adjuntar documentos y vea como van apareciendo cuando inicia sesion con el administrador.

Puede editar los usuarios desde https://susitioweb.com/iccti/users como asi tambien puede cambiar el rol o crear nuevos administradores, el postulante 1 es necesario para los administradores, no lo borre.
