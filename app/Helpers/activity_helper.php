<?php 

if (!function_exists('activity'))
{
    /**
     *  Activity Logger
     *  function helper for save log
     *  @param $description 
     *  @return Activity Object
     **/
    function activity($description = null) {
        $userType   = 'Visitante';
        $userId     = null;

        if(\Auth::check()) {
            $userType   = 'Registrado';
            $userId     = \Request::user()->id;
        }

        if (!$description) {
            switch (strtolower(\Request::method())) {
                case 'post':
                    $verb = 'Creado';
                    break;
                case 'patch':
                case 'put':
                    $verb = 'Editado';
                    break;
                case 'delete':
                    $verb = 'Borrado';
                    break;
                case 'get':
                default:
                    $verb = 'Ver';
                    break;
            }
            $description = $verb . ' ' . \Request::path();
        }

        $data = [
            'description'    => $description,
            'user_type'      => $userType,
            'user_id'        => $userId,
            'route'          => \Request::fullUrl(),
            'ip_address'     => \Request::ip(),
            'user_agent'     => \Request::userAgent(),
            'locale'         => \Request::header('accept-language'),
            'referer'        => \Request::header('referer'),
            'method_type'    => \Request::method(),
        ];

        // Validation Instance
        return \App\Activity::create($data);
    }
}
