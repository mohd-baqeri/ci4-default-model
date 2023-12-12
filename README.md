# ci4-default-model
A MUST model for CodeIgniter 4 projects.

INSTALLATION:
  Just download the file "DefaultModel.php" and put it in the "Models" directory of your CodeIgniter project.

Full CRUD functions for Codeigniter 4:

By the following functions, you can do whatever can be done by a model:

     * addTblRow($tbl, $data)
     
     * updateTblRow($tbl, $data, $where = [])
     
     * getTblRows($tbl, $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
     
     * getTblRowsJoin($tbl1, $tbl2, $onClause, $select = '*', $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
     
     * searchTblRows($tbl, $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
     
     * searchTblRowsJoin($tbl1, $tbl2, $onClause, $select = '*', $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
     
     * getTblRow($tbl, $where = [])

     * getTblRowNext($tbl, $current_col_name, $current_col_val, $where = [])

     * getTblRowPrev($tbl, $current_col_name, $current_col_val, $where = [])

     * getTblRowFirst($tbl, $where = [], $orderBy = 'id ASC')

     * getTblRowLast($tbl, $where = [], $orderBy = 'id DESC')

     * getTblRowMath($tbl, $math = 'SUM', $col, $where = [])
     
     * getTblRowJoin($tbl1, $tbl2, $onClause, $select = '*', $where = [])
     
     * deleteTblRow($tbl, $where = [], $status = 'delete')
     
     * getTblRowsDistinct($tbl, $col = false, $where = [])


