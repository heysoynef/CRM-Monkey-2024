<?php
// * ELEMENTOR FORMS *
add_action('elementor_pro/forms/new_record', function ($record, $ajax_handler) {
    // Configura la zona horaria a 'America/Mexico_City'
    date_default_timezone_set('America/Mexico_City');

    // Obtiene los campos del registro
    $raw_fields = $record->get('fields');
    $fields = [];
    foreach ($raw_fields as $id => $field) {
        $fields[$id] = $field['value'];
    }

    // Establece la conexión a la base de datos
    $db_host = '154.56.47.154'; // Cambia esto si el host de la base de datos es diferente
    $db_name = 'u304955714_crm'; // Nombre de la base de datos
    $db_user = 'u304955714_crm'; // Usuario de la base de datos
    $db_password = 'Monkey2023**'; // Contraseña de la base de datos

    // Crea una nueva instancia de wpdb para la conexión a la base de datos específica
    $wpdb_remote = new wpdb($db_user, $db_password, $db_name, $db_host);

    // Inserta los datos en la base de datos remota
    $output['success'] = $wpdb_remote->insert(
        $wpdb_remote->prefix . 'prepaenlinea',
        array(
            'nombre' => $fields['nombre'],
            'email' => $fields['email'],
            'telefono' => $fields['telefono'],
            'fecha' => date('Y-m-d H:i:s') // Esto establece la fecha y hora actual
        )
    );

    // Agrega los datos de respuesta al controlador de Ajax
    $ajax_handler->add_response_data(true, $output);
}, 10, 2);
?>
