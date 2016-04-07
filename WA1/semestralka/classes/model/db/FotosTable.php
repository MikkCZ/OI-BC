<?php

/**
 * FotosTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @author Michal Stanke <michal.stanke@mikk.cz>
 */
class FotosTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object FotosTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Fotos');
    }

    /**
     * Returns the total number of fotos in the gallery.
     * 
     * @param Galleries $gallery
     * @return integer number of fotos
     */
    public function getCountForGallery(Galleries $gallery) {
        $q = Doctrine_Query::create()
                ->select('COUNT(f.id) count')
                ->from('fotos f')
                ->where('f.gallery_id = ?', $gallery->getID());
        $array = $q->fetchArray();
        return intval($array[0]['count']);
    }

    /**
     * Returns fotos from the given gallery in an array.
     * 
     * @param Galleries $gallery
     * @return array fotos of the given gallery
     */
    public function getForGallery(Galleries $gallery, $page = 0, $limit = 20) {
        $q = Doctrine_Query::create()
                ->select('f.id, f.name, f.filename, f.thumbname')
                ->from('fotos f')
                ->where('f.gallery_id = ?', $gallery->getID())
                ->orderBy('f.uploaded ASC')
                ->limit($limit)
                ->offset($page * $limit);
        return $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
    }

    /**
     * Checks the filename is already present in the gallery.
     * 
     * @param Galleries $gallery
     * @param string $filename
     * @return Fotos foto
     */
    public function existsForGallery(Galleries $gallery, $filename) {
        $q = Doctrine_Query::create()
                ->select('f.id')
                ->from('fotos f')
                ->where('f.gallery_id = ?', $gallery->getID())
                ->where('f.filename = ?', $filename);
        return $q->fetchOne();
    }

    public function getByID($id) {
        $q = Doctrine_Query::create()
                ->from('fotos f')
                ->where('f.id = ?', $id);
        return $q->fetchOne();
    }

}