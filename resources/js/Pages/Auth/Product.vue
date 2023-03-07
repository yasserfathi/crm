<template>
    <Head title="Products " />
    <v-app id="inspire">
        <Header />

        <v-main class="bg-grey-lighten-3">
            <v-container>
                <v-row>
                    <v-col cols="3">
                        <Menu />
                    </v-col>

                    <v-col>
                        <v-sheet min-height="40vh" rounded="lg">
                            <v-container>
                                <v-data-table :headers="headers" :items="products" item-value="profile" :items-per-page="5"
                                    :sort-by="[{ key: 'name', order: 'asc' }]" class="elevation-1">
                                    <template v-slot:top>
                                        <v-toolbar color="#ddd" flat>
                                            <v-toolbar-title>Products</v-toolbar-title>
                                            <v-divider class="mx-4" inset vertical></v-divider>
                                            <v-spacer></v-spacer>
                                            <v-dialog v-model="dialog" max-width="500px">
                                                <template v-slot:activator="{ props }">
                                                    <v-btn color="primary" dark class="mb-2" v-bind="props" variant="flat">
                                                        <v-icon icon="mdi-plus"></v-icon>
                                                    </v-btn>
                                                </template>
                                                <v-card>
                                                    <v-card-title variant="flat" color="black">
                                                        <span class="text-h6">{{ formTitle }}</span>
                                                    </v-card-title>
                                                    <v-form ref="form" fast-fail @submit.prevent>
                                                    <v-card-text>
                                                        <v-container>
                                                            <v-row>
                                                                <v-col cols="12" sm="12" md="12">
                                                                    <v-text-field v-model="editedItem.name" variant="underlined" :rules="nameRules"
                                                                        label="Name"></v-text-field>
                                                                    <input type="hidden" v-model="editedItem.id">
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-card-text>
                                                    </v-form>

                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-btn color="error" variant="flat" @click="close">
                                                            Cancel
                                                        </v-btn>
                                                        <v-btn color="success" variant="flat" @click="save">
                                                            {{ formSaveEdit }}
                                                        </v-btn>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-dialog>
                                            <v-dialog v-model="dialogDelete" max-width="480px">
                                                <v-card>
                                                    <v-card-title class="text-h5">Are you sure you want to delete this
                                                        item?</v-card-title>
                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-btn color="error" variant="flat"
                                                            @click="closeDelete">Cancel</v-btn>
                                                        <v-btn color="success" variant="flat"
                                                            @click="deleteItemConfirm">OK</v-btn>
                                                        <v-spacer></v-spacer>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-dialog>
                                        </v-toolbar>
                                    </template>
                                    <template v-slot:item.actions="{ item }">
                                        <v-icon size="small" class="me-2" @click="editItem(item.raw)">
                                            mdi-pencil
                                        </v-icon>
                                        <v-icon size="small" @click="deleteItem(item.raw)">
                                            mdi-delete
                                        </v-icon>
                                    </template>
                                </v-data-table>
                            </v-container>
                        </v-sheet>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import { Head,useForm  } from '@inertiajs/vue3';
import { useTheme } from 'vuetify'
import { VDataTable } from 'vuetify/labs/VDataTable'
import Header from './Header.vue';
import Menu from './Menu.vue';
export default {
    props:{
        products:Array,
    },
    data: () => ({
        dialog: false,
        dialogDelete: false,
        headers: [
            {
                title: 'Name',
                align: 'start',
                sortable: true,
                key: 'name',
            },
            { title: 'Actions', key: 'actions', sortable: false },
        ],
        editedIndex: -1,
        editedItem: {
            id: '',
            name: '',
        },
        defaultItem: {
            id: '',
            name: '',
        },
        items: [
            { text: "Users", icon: "mdi-account-group" },
            { text: "Audience", icon: "mdi-account" },
            { text: "Conversions", icon: "mdi-flag" },
        ],
        nameRules: [ (v) => !!v || "Name is required",],
    }),

    setup() {
        const theme = useTheme()
        const dataForm = useForm({
            id: '',
            name: '',
        });

        return {
            theme,dataForm,
            toggleTheme: () => theme.global.name.value = theme.global.current.value.dark ? 'light' : 'dark'
        }
    },

    components: {
        Head,
        VDataTable,
        Header,
        Menu
    },

    computed: {
        formTitle() {
            return this.editedItem.id === '' ? 'New Item' : 'Edit Item'
        },
        formSaveEdit() {
            return this.editedItem.id === '' ? 'Save' : 'Edit'
        }
    },

    watch: {
        dialog(val) {
            val || this.close()
        },
        dialogDelete(val) {
            val || this.closeDelete()
        },
    },

    methods: {
        editItem(item) {
            this.editedIndex = this.products.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            this.editedIndex = this.products.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            this.dataForm.delete(route('product.destroy',this.editedItem.id), {
                preserveScroll: true,
            });
            this.closeDelete()
        },

        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        async save() {
            this.dataForm.id = this.editedItem.id;
            this.dataForm.name = this.editedItem.name;
            const { valid } = await this.$refs.form.validate();
            if (valid){
                this.error = "";
                if(this.editedItem.id === ''){
                    this.dataForm.post(route('product.store'), {
                        preserveScroll: true,
                        onSuccess: () => {
                            this.dataForm.reset();
                        },
                        onError: (response) => {
                            this.error = response.email;
                        },
                        onFinish: () => this.dataForm.reset(),
                    });
                }
                else
                {
                    this.dataForm.put(route('product.update',this.dataForm.id), {
                        preserveScroll: true,
                        onSuccess: () => {
                            this.dataForm.reset();
                        },
                        onError: (response) => {
                            this.error = response.email;
                        },
                        onFinish: () => this.dataForm.reset(),
                    });
                }
            }
            this.close();
        },
    },
}
</script>
