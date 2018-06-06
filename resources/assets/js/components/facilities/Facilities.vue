<template>
    <div class="card">
        <div class="header">
            <h4 class="title">All Facilities</h4>
        </div>
        <div class="content table-responsive">
            <table id="facilities" class="table table-striped table-no-bordered table-hover"></table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['facilities'],
        data() {
            return {
                headers: [
                    { title: 'S/N' },
                    { title: 'Facility Name' },
                    { title: 'Facility Code'},
                    { title: 'County' },
                    { title: 'Facility Type' },
                    { title: 'Facility Owner' },
                    { title: 'Actions' },
                ],
                allFacilities: [],
                rows: [] ,
                dtHandle: null
            }
        },
        created() {
            this.allFacilities = this.facilities;
        },
        watch: {
            allFacilities(val, oldVal) {
                let vm = this;
                vm.rows = [];

                val.forEach(function (item) {

                    let row = [];
        
                    row.push(item.id);
                    row.push(item.name);
                    row.push(item.facility_code);
                    row.push(item.county.name);
                    row.push(item.type.name);
                    row.push(item.owner.name);
                    row.push('<a href="facilities/'+ item.id +'" class="btn btn-default btn-xs">View</a>');

                    vm.rows.push(row);
                });

                //Clear, Add, and redraw datable rows
                vm.dtHandle.clear();
                vm.dtHandle.rows.add(vm.rows);
                vm.dtHandle.draw();
            }
        },
        mounted() {
            //Instantiate the datatable and store the reference to the instance in our dtHandle element.
            this.dtHandle = $('#facilities').DataTable({
                columns: this.headers,
                data: this.rows,
                "autoWidth": false,
                "responsive": true
            });
        }
    }
</script>