# ci4-default-model
A MUST model for CodeIgniter 4 projects.

INSTALLATION:
  Just download the file "DefaultModel.php" and put it in the "Models" directory of your CodeIgniter project.

Full CRUD functions for Codeigniter 4:

By the following functions, you can do whatever can be done by a model:

     * addRow($tbl, $data)
     
     * updateRow($tbl, $data, $where = [])
     
     * deleteRow($tbl, $where = [], $status = 'delete')

     * getRows($tbl, $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)

     * getRowsIn($tbl, $whereInCol, $whereInVal, $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)

     * getRowsJoin($tbl1, $tbl2, $onClause, $select = '*', $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)

     * getRowsSearch($tbl, $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)

     * getRowsSearchJoin($tbl1, $tbl2, $onClause, $select = '*', $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)

     * getDistinctRows($tbl, $distinct_col, $where = [])

     * getRow($tbl, $where = [])

     * getRowIn($tbl, $whereInCol, $whereInVal, $where = [])

     * getNextRow($tbl, $current_col_name, $current_col_val, $where = [])

     * getPrevRow($tbl, $current_col_name, $current_col_val, $where = [])

     * getFirstRow($tbl, $where = [], $orderBy = 'id ASC')

     * getLastRow($tbl, $where = [], $orderBy = 'id DESC')

     * getRowMath($tbl, $math = 'SUM', $col, $where = [])

     * getRowJoin($tbl1, $tbl2, $onClause, $select = '*', $where = [], $orderBy = '')


