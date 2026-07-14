<?php
// SC-504 Lenguajes de Base de Datos - Proyecto Real English CR - Grupo F
// Granados, Perez, Rodriguez, Valverde
//
// Catalogo de entidades: describe cada tabla de la BD para que el CRUD
// generico sepa que paquete llamar, que campos pintar en el formulario
// y como validarlos. El ORDEN de los campos debe coincidir con el orden
// de los parametros de insertar/actualizar en los paquetes pkg_<tabla>_crud.
//
// Tipos de campo:
//   texto / numero / decimal / fecha / textarea
//   select   -> opciones fijas (los CHECK de la tabla)
//   fk       -> combo que se llena con el listar() de otra entidad

class Entidades
{
    public static function todas()
    {
        return [

        'regiones' => [
            'titulo'  => 'Regiones',
            'paquete' => 'REALENGLISH.pkg_regiones_crud',
            'pk'      => 'region_id',
            'campos'  => [
                'nombre' => ['etiqueta' => 'Nombre', 'tipo' => 'texto', 'requerido' => true],
            ],
        ],

        'sedes' => [
            'titulo'  => 'Sedes',
            'paquete' => 'REALENGLISH.pkg_sedes_crud',
            'pk'      => 'sede_id',
            'campos'  => [
                'nombre'        => ['etiqueta' => 'Nombre', 'tipo' => 'texto', 'requerido' => true],
                'direccion'     => ['etiqueta' => 'Direccion', 'tipo' => 'texto', 'requerido' => true],
                'ciudad'        => ['etiqueta' => 'Ciudad', 'tipo' => 'texto', 'requerido' => true],
                'codigo_postal' => ['etiqueta' => 'Codigo postal', 'tipo' => 'texto', 'requerido' => false],
                'telefono'      => ['etiqueta' => 'Telefono', 'tipo' => 'texto', 'requerido' => false],
                'region_id'     => ['etiqueta' => 'Region', 'tipo' => 'fk', 'requerido' => true,
                                    'fk' => ['entidad' => 'regiones', 'valor' => 'REGION_ID', 'texto' => ['NOMBRE']]],
            ],
        ],

        'niveles' => [
            'titulo'  => 'Niveles',
            'paquete' => 'REALENGLISH.pkg_niveles_crud',
            'pk'      => 'nivel_id',
            'campos'  => [
                'codigo'      => ['etiqueta' => 'Codigo MCER', 'tipo' => 'select', 'requerido' => true,
                                  'opciones' => ['A1','A2','B1','B2','C1','C2']],
                'nombre'      => ['etiqueta' => 'Nombre', 'tipo' => 'texto', 'requerido' => true],
                'descripcion' => ['etiqueta' => 'Descripcion', 'tipo' => 'textarea', 'requerido' => false],
                'orden'       => ['etiqueta' => 'Orden', 'tipo' => 'numero', 'requerido' => true],
            ],
        ],

        'departamentos' => [
            'titulo'  => 'Departamentos',
            'paquete' => 'REALENGLISH.pkg_departamentos_crud',
            'pk'      => 'departamento_id',
            'campos'  => [
                'nombre'  => ['etiqueta' => 'Nombre', 'tipo' => 'texto', 'requerido' => true],
                'sede_id' => ['etiqueta' => 'Sede', 'tipo' => 'fk', 'requerido' => false,
                              'fk' => ['entidad' => 'sedes', 'valor' => 'SEDE_ID', 'texto' => ['NOMBRE']]],
            ],
        ],

        'puestos' => [
            'titulo'    => 'Puestos',
            'paquete'   => 'REALENGLISH.pkg_puestos_crud',
            'pk'        => 'puesto_id',
            'pk_manual' => true,  // el ID lo digita el usuario (ej. PROF_ING)
            'campos'    => [
                'titulo'      => ['etiqueta' => 'Titulo del puesto', 'tipo' => 'texto', 'requerido' => true],
                'salario_min' => ['etiqueta' => 'Salario minimo', 'tipo' => 'decimal', 'requerido' => false],
                'salario_max' => ['etiqueta' => 'Salario maximo', 'tipo' => 'decimal', 'requerido' => false],
            ],
        ],

        'empleados' => [
            'titulo'  => 'Empleados',
            'paquete' => 'REALENGLISH.pkg_empleados_crud',
            'pk'      => 'empleado_id',
            'campos'  => [
                'cedula'          => ['etiqueta' => 'Cedula', 'tipo' => 'texto', 'requerido' => true],
                'nombre'          => ['etiqueta' => 'Nombre', 'tipo' => 'texto', 'requerido' => true],
                'apellido_p'      => ['etiqueta' => 'Primer apellido', 'tipo' => 'texto', 'requerido' => true],
                'apellido_m'      => ['etiqueta' => 'Segundo apellido', 'tipo' => 'texto', 'requerido' => false],
                'correo'          => ['etiqueta' => 'Correo', 'tipo' => 'texto', 'requerido' => true],
                'telefono'        => ['etiqueta' => 'Telefono', 'tipo' => 'texto', 'requerido' => false],
                'fecha_ingreso'   => ['etiqueta' => 'Fecha de ingreso', 'tipo' => 'fecha', 'requerido' => true],
                'salario'         => ['etiqueta' => 'Salario', 'tipo' => 'decimal', 'requerido' => true],
                'puesto_id'       => ['etiqueta' => 'Puesto', 'tipo' => 'fk', 'requerido' => true,
                                      'fk' => ['entidad' => 'puestos', 'valor' => 'PUESTO_ID', 'texto' => ['TITULO']]],
                'departamento_id' => ['etiqueta' => 'Departamento', 'tipo' => 'fk', 'requerido' => true,
                                      'fk' => ['entidad' => 'departamentos', 'valor' => 'DEPARTAMENTO_ID', 'texto' => ['NOMBRE']]],
                'nivel_ingles'    => ['etiqueta' => 'Nivel de ingles', 'tipo' => 'select', 'requerido' => false,
                                      'opciones' => ['A1','A2','B1','B2','C1','C2']],
                'especialidad'    => ['etiqueta' => 'Especialidad', 'tipo' => 'texto', 'requerido' => false],
                'activo'          => ['etiqueta' => 'Activo', 'tipo' => 'select', 'requerido' => true,
                                      'opciones' => ['S','N']],
            ],
        ],

        'aulas' => [
            'titulo'  => 'Aulas',
            'paquete' => 'REALENGLISH.pkg_aulas_crud',
            'pk'      => 'aula_id',
            'campos'  => [
                'nombre'          => ['etiqueta' => 'Nombre', 'tipo' => 'texto', 'requerido' => true],
                'capacidad'       => ['etiqueta' => 'Capacidad (1-30)', 'tipo' => 'numero', 'requerido' => true],
                'sede_id'         => ['etiqueta' => 'Sede', 'tipo' => 'fk', 'requerido' => true,
                                      'fk' => ['entidad' => 'sedes', 'valor' => 'SEDE_ID', 'texto' => ['NOMBRE']]],
                'tiene_proyector' => ['etiqueta' => 'Tiene proyector', 'tipo' => 'select', 'requerido' => true,
                                      'opciones' => ['S','N']],
            ],
        ],

        'estudiantes' => [
            'titulo'  => 'Estudiantes',
            'paquete' => 'REALENGLISH.pkg_estudiantes_crud',
            'pk'      => 'estudiante_id',
            'campos'  => [
                'cedula'           => ['etiqueta' => 'Cedula', 'tipo' => 'texto', 'requerido' => true],
                'nombre'           => ['etiqueta' => 'Nombre', 'tipo' => 'texto', 'requerido' => true],
                'apellido_p'       => ['etiqueta' => 'Primer apellido', 'tipo' => 'texto', 'requerido' => true],
                'apellido_m'       => ['etiqueta' => 'Segundo apellido', 'tipo' => 'texto', 'requerido' => false],
                'correo'           => ['etiqueta' => 'Correo', 'tipo' => 'texto', 'requerido' => true],
                'telefono'         => ['etiqueta' => 'Telefono', 'tipo' => 'texto', 'requerido' => false],
                'fecha_nacimiento' => ['etiqueta' => 'Fecha de nacimiento', 'tipo' => 'fecha', 'requerido' => true],
                'nivel_actual_id'  => ['etiqueta' => 'Nivel actual', 'tipo' => 'fk', 'requerido' => false,
                                       'fk' => ['entidad' => 'niveles', 'valor' => 'NIVEL_ID', 'texto' => ['CODIGO','NOMBRE']]],
                'activo'           => ['etiqueta' => 'Activo', 'tipo' => 'select', 'requerido' => true,
                                       'opciones' => ['S','N']],
            ],
        ],

        'cursos' => [
            'titulo'  => 'Cursos',
            'paquete' => 'REALENGLISH.pkg_cursos_crud',
            'pk'      => 'curso_id',
            'campos'  => [
                'codigo'         => ['etiqueta' => 'Codigo', 'tipo' => 'texto', 'requerido' => true],
                'nombre'         => ['etiqueta' => 'Nombre', 'tipo' => 'texto', 'requerido' => true],
                'descripcion'    => ['etiqueta' => 'Descripcion', 'tipo' => 'textarea', 'requerido' => false],
                'duracion_horas' => ['etiqueta' => 'Duracion (horas)', 'tipo' => 'numero', 'requerido' => true],
                'nivel_id'       => ['etiqueta' => 'Nivel', 'tipo' => 'fk', 'requerido' => true,
                                     'fk' => ['entidad' => 'niveles', 'valor' => 'NIVEL_ID', 'texto' => ['CODIGO','NOMBRE']]],
                'precio_colones' => ['etiqueta' => 'Precio (colones)', 'tipo' => 'decimal', 'requerido' => true],
                'modalidad'      => ['etiqueta' => 'Modalidad', 'tipo' => 'select', 'requerido' => true,
                                     'opciones' => ['PRESENCIAL','VIRTUAL','HIBRIDO']],
            ],
        ],

        'grupos' => [
            'titulo'  => 'Grupos',
            'paquete' => 'REALENGLISH.pkg_grupos_crud',
            'pk'      => 'grupo_id',
            'campos'  => [
                'codigo'       => ['etiqueta' => 'Codigo', 'tipo' => 'texto', 'requerido' => true],
                'curso_id'     => ['etiqueta' => 'Curso', 'tipo' => 'fk', 'requerido' => true,
                                   'fk' => ['entidad' => 'cursos', 'valor' => 'CURSO_ID', 'texto' => ['CODIGO','NOMBRE']]],
                'profesor_id'  => ['etiqueta' => 'Profesor', 'tipo' => 'fk', 'requerido' => true,
                                   'fk' => ['entidad' => 'empleados', 'valor' => 'EMPLEADO_ID', 'texto' => ['NOMBRE','APELLIDO_P']]],
                'aula_id'      => ['etiqueta' => 'Aula', 'tipo' => 'fk', 'requerido' => true,
                                   'fk' => ['entidad' => 'aulas', 'valor' => 'AULA_ID', 'texto' => ['NOMBRE']]],
                'dias'         => ['etiqueta' => 'Dias (ej. L-M-V)', 'tipo' => 'texto', 'requerido' => true],
                'horario'      => ['etiqueta' => 'Horario (ej. 18:00-21:00)', 'tipo' => 'texto', 'requerido' => true],
                'fecha_inicio' => ['etiqueta' => 'Fecha de inicio', 'tipo' => 'fecha', 'requerido' => true],
                'fecha_fin'    => ['etiqueta' => 'Fecha de fin', 'tipo' => 'fecha', 'requerido' => true],
                'cupo_max'     => ['etiqueta' => 'Cupo maximo', 'tipo' => 'numero', 'requerido' => true],
                'estado'       => ['etiqueta' => 'Estado', 'tipo' => 'select', 'requerido' => true,
                                   'opciones' => ['ABIERTO','EN_CURSO','CERRADO','CANCELADO']],
            ],
        ],

        'matriculas' => [
            'titulo'  => 'Matriculas',
            'paquete' => 'REALENGLISH.pkg_matriculas_crud',
            'pk'      => 'matricula_id',
            'campos'  => [
                'estudiante_id'   => ['etiqueta' => 'Estudiante', 'tipo' => 'fk', 'requerido' => true,
                                      'fk' => ['entidad' => 'estudiantes', 'valor' => 'ESTUDIANTE_ID', 'texto' => ['NOMBRE','APELLIDO_P']]],
                'grupo_id'        => ['etiqueta' => 'Grupo', 'tipo' => 'fk', 'requerido' => true,
                                      'fk' => ['entidad' => 'grupos', 'valor' => 'GRUPO_ID', 'texto' => ['CODIGO']]],
                'fecha_matricula' => ['etiqueta' => 'Fecha de matricula (vacio = hoy)', 'tipo' => 'fecha', 'requerido' => false],
                'nota_final'      => ['etiqueta' => 'Nota final (0-100)', 'tipo' => 'decimal', 'requerido' => false],
                'estado'          => ['etiqueta' => 'Estado', 'tipo' => 'select', 'requerido' => true,
                                      'opciones' => ['ACTIVA','APROBADA','REPROBADA','RETIRADA']],
            ],
        ],

        'pagos' => [
            'titulo'  => 'Pagos',
            'paquete' => 'REALENGLISH.pkg_pagos_crud',
            'pk'      => 'pago_id',
            'campos'  => [
                'matricula_id'      => ['etiqueta' => 'Matricula', 'tipo' => 'fk', 'requerido' => true,
                                        'fk' => ['entidad' => 'matriculas', 'valor' => 'MATRICULA_ID', 'texto' => ['MATRICULA_ID','ESTADO']]],
                'monto'             => ['etiqueta' => 'Monto (colones)', 'tipo' => 'decimal', 'requerido' => true],
                'fecha_pago'        => ['etiqueta' => 'Fecha de pago', 'tipo' => 'fecha', 'requerido' => false],
                'fecha_vencimiento' => ['etiqueta' => 'Fecha de vencimiento', 'tipo' => 'fecha', 'requerido' => true],
                'metodo_pago'       => ['etiqueta' => 'Metodo de pago', 'tipo' => 'select', 'requerido' => false,
                                        'opciones' => ['EFECTIVO','TARJETA','TRANSFERENCIA','SINPE']],
                'estado'            => ['etiqueta' => 'Estado', 'tipo' => 'select', 'requerido' => true,
                                        'opciones' => ['PENDIENTE','PAGADO','ATRASADO','ANULADO']],
            ],
        ],

        'asistencia' => [
            'titulo'  => 'Asistencia',
            'paquete' => 'REALENGLISH.pkg_asistencia_crud',
            'pk'      => 'asistencia_id',
            'campos'  => [
                'matricula_id'  => ['etiqueta' => 'Matricula', 'tipo' => 'fk', 'requerido' => true,
                                    'fk' => ['entidad' => 'matriculas', 'valor' => 'MATRICULA_ID', 'texto' => ['MATRICULA_ID','ESTADO']]],
                'fecha_clase'   => ['etiqueta' => 'Fecha de la clase', 'tipo' => 'fecha', 'requerido' => true],
                'estado'        => ['etiqueta' => 'Estado', 'tipo' => 'select', 'requerido' => true,
                                    'opciones' => ['PRESENTE','AUSENTE','TARDE','JUSTIFICADO']],
                'observaciones' => ['etiqueta' => 'Observaciones', 'tipo' => 'textarea', 'requerido' => false],
            ],
        ],

        'evaluaciones' => [
            'titulo'  => 'Evaluaciones',
            'paquete' => 'REALENGLISH.pkg_evaluaciones_crud',
            'pk'      => 'evaluacion_id',
            'campos'  => [
                'matricula_id'     => ['etiqueta' => 'Matricula', 'tipo' => 'fk', 'requerido' => true,
                                       'fk' => ['entidad' => 'matriculas', 'valor' => 'MATRICULA_ID', 'texto' => ['MATRICULA_ID','ESTADO']]],
                'tipo'             => ['etiqueta' => 'Tipo', 'tipo' => 'select', 'requerido' => true,
                                       'opciones' => ['QUIZ','PARCIAL','FINAL','ORAL','PROYECTO','TAREA']],
                'fecha_evaluacion' => ['etiqueta' => 'Fecha', 'tipo' => 'fecha', 'requerido' => true],
                'nota'             => ['etiqueta' => 'Nota (0-100)', 'tipo' => 'decimal', 'requerido' => true],
                'porcentaje'       => ['etiqueta' => 'Porcentaje (1-100)', 'tipo' => 'decimal', 'requerido' => true],
                'comentarios'      => ['etiqueta' => 'Comentarios', 'tipo' => 'textarea', 'requerido' => false],
            ],
        ],

        'bitacora' => [
            'titulo'  => 'Bitacora',
            'paquete' => 'REALENGLISH.pkg_bitacora_crud',
            'pk'      => 'bitacora_id',
            'campos'  => [
                'tabla'       => ['etiqueta' => 'Tabla', 'tipo' => 'texto', 'requerido' => true],
                'operacion'   => ['etiqueta' => 'Operacion', 'tipo' => 'select', 'requerido' => true,
                                  'opciones' => ['INSERT','UPDATE','DELETE']],
                'registro_id' => ['etiqueta' => 'ID del registro', 'tipo' => 'texto', 'requerido' => false],
                'detalles'    => ['etiqueta' => 'Detalles', 'tipo' => 'textarea', 'requerido' => false],
            ],
        ],

        ];
    }

    // Devuelve la definicion de una entidad o null si no existe
    public static function obtener($nombre)
    {
        $todas = self::todas();
        return isset($todas[$nombre]) ? $todas[$nombre] : nu