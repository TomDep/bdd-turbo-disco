<!-- Meta tag -->
<meta charset="utf-8">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<!-- Bootstrap Icon -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

<!-- jQuery library v3.5.1 -->
<script src="../plugins/jQuery-3.5.1/jquery.min.js"></script>

<!-- Table Filter -->
<script src="../plugins/fast-table-filter-26.11.2018/jquery.tablefilter.min.js"></script>
<script>
    // Setup the table filter plugin
    $(document).ready(() => {
        $('.filter').each((i, obj) => $(obj).TableFilter());
    });
</script>
