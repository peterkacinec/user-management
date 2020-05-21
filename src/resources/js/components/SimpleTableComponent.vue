<template>
    <table class="table table-striped table-hover table-sm table-responsive-xl">
        <thead class="thead-dark">
            <tr>
                <th v-for="column in columns" :key="column.key"
                    style="cursor:pointer;">{{column.label}}
                </th>
                <th style="width: 140px" v-if="actions.length > 0">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in data" :key="item.id">
                <td class="align-middle" v-for="column in columns">{{ item[column.key] }}</td>
                <td v-if="actions.length > 0" class="align-middle" style="width: 150px">
                    <div>
                        <a
                            type="button"
                            v-bind:href="action.url ? (action.url.link + item[action.url.attribute]) : ''"
                            v-for="action in actions"
                            :class="action.class"
                            v-html="action.label"
                            onclick="this.blur();"
                        >{{action.label}}</a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: ['config'],
        data() {
            let res = this.loadData(this.config);

            if (res) {
                const data    = res.data || {};
                const columns = res.columns || {};
                const actions = res.actions || {};

                return {
                    data,
                    columns,
                    actions
                }
            }
        },
        methods: {
            loadData(data) {
                return JSON.parse(data);
            }
        }
    };
</script>
