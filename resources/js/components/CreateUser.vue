<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create user</div>

                    <div class="card-body">
                        <form action="" @submit.prevent="simpan">
                            <div class="form-group">
                                <label for="user">Name</label>
                                <input type="text" class="form-control" v-model="name" required>
                            </div>
                            <button class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <notifications/>
    </div>
</template>

<script>
export default {
    data(){
        return{
            name:""
        }
    },
    methods:{
        simpan(){
            axios.post('/api/cs', {
                name : this.name
            })
                .then(res => {
                    this.name = "",
                    this.$notify({
                        title: 'notification',
                        text: 'penyimpanan sukses'
                    });
                })

        }
    }
}
</script>
