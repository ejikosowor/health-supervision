<template>
    <div class="card">
        <div class="header">
            <h4 class="title">Supervisions</h4>
        </div>
        <div class="content table-responsive">
            <table id="supervisions" class="table table-striped table-no-bordered table-hover"></table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['supervisions'],
        data() {
            return {
                headers: [
                    { title: 'Category'},
                    { title: 'Supervisor' },
                    { title: 'Date' },
                    { title: 'Actions' },
                ],
                allSupervisions: [],
                rows: [] ,
                dtHandle: null
            }
        },
        created() {
            this.allSupervisions = this.supervisions;
        },
        watch: {
            allSupervisions(val, oldVal){
                let vm = this;
                vm.rows = [];

                val.forEach(function (item) {
                    let row = [];

                    row.push(item.category.name);
                    row.push(item.supervisor.name);
                    row.push(moment(item.created_at).format('MMM Do YYYY, h:mm a'));
                    row.push('<a href="supervisions/'+item.id+'" class="btn btn-default btn-xs">View</a>');

                    vm.rows.push(row);
                });

                //Clear, Add, and redraw datable rows
                vm.dtHandle.clear();
                vm.dtHandle.rows.add(vm.rows);
                vm.dtHandle.draw();
            }
        },
        mounted() {
            this.dtHandle = $('#supervisions').DataTable({
                columns: this.headers,
                data: this.rows,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "emptyTable": "Sorry! No Supervisions Have been conducted."
                }
            });
        }
    }
</script>