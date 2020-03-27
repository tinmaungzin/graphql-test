<template>
    <div class="show">
        <ApolloQuery :query="require('@/graphql/queries/user.gql')" :variables="{ id: id }">
            <template slot-scope="{ result: { data, loading },isLoading }">
                <div v-if="isLoading">Loading...</div>
                    <h3>Name : {{data.user[0].name}}</h3>
                    <h3>Email : {{data.user[0].email}}</h3>


                <router-link :to="{ name: 'Edit', params: {id: data.user[0].id } }">Edit</router-link>


                <ApolloMutation :mutation="require('@/graphql/mutations/deleteUser.gql')"
                                :variables="{id: data.user[0].id}"
                                @done="onDone">
                    <template v-slot="{ mutate, loading, error }">

                        <form >
                            <button type="submit" :disabled="loading" @click="mutate()" class="btn btn-primary btn-sm">Delete</button>
                        </form>
                        <p v-if="error">An error occurred: {{ error }}</p>
                    </template>
                </ApolloMutation>


            </template>
        </ApolloQuery>
    </div>
</template>

<script>
    export default {
        name: 'Show',
        props : ['id'],
        methods: {
            onDone(){
                this.$router.push('/')
            }
        },

    }
</script>
