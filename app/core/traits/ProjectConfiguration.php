<?php

namespace app\core\traits;

trait ProjectConfiguration
{
    public static function create_version_number( $version )
    {
        $parts       = explode( ".", $version );
        $total_parts = count( $parts );

        if( $total_parts === 4 ): /** Status is validate */
            $version = "0.0.0.1";
        elseif( $total_parts === 3 ): /** Status is testing */
            $version = "0.0.1";
        elseif( $total_parts === 2 ): /** Status is acceptation */
            $version = "0.1";
        elseif( $total_parts === 1 ): /** Status is production */
            $version = "1";
        endif;

        return( $version );
    }

    public static function update_version_number( $version )
    {
        $parts       = explode( ".", $version );
        $total_parts = count( $parts );

        if( $total_parts === 4 ): /** Status is validate */
            $version = "0.0.0." . ( $parts[3] + 1 );
        elseif( $total_parts === 3 ): /** Status is testing */
            $version = "0.0." . ( $parts[2] + 1 );
        elseif( $total_parts === 2 ): /** Status is acceptation */
            $version = "0." . ( $parts[1] + 1 );
        elseif( $total_parts === 1 ): /** Status is production */
            $version = "" . ( $parts[0] + 1 );
        endif;

        return( $version );
    }


    public static function sub_branches_recursive( $branches, $parentID )
    {
        $data = [];
        foreach( $branches as $branch ):
            if( $branch->parent === $parentID ):
                $data[] = $branch;
            endif;
        endforeach;

        var_dump($data);
    }
}

