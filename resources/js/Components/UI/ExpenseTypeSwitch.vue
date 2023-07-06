<script setup>
import useStore from '@/store/store';

const store = useStore();
</script>

<template>
  <div class="text-center">
    <button
      :class="`rounded-l-xl border border-slate-500 px-4 py-2 text-sm font-bold shadow-lg ${
        store.expenseType === 'budget' ? 'bg-slate-400' : 'bg-slate-200'
      } w-32 hover:bg-slate-400`"
      @click.prevent="store.setExpenseType('budget')"
    >
      Budgets
    </button>
    <button
      :class="`border border-slate-500 px-4 py-2 text-sm font-bold shadow-lg ${
        store.expenseType === 'bill' ? 'bg-slate-400' : 'bg-slate-200'
      } w-32 hover:bg-slate-400`"
      @click.prevent="store.setExpenseType('bill')"
    >
      Bills
    </button>
    <button
      :class="`rounded-r-xl border border-slate-500 px-4 py-2 text-sm font-bold shadow-lg ${
        store.expenseType === 'saving' ? 'bg-slate-400' : 'bg-slate-200'
      } w-32 hover:bg-slate-400`"
      @click.prevent="store.setExpenseType('saving')"
    >
      Savings
    </button>
  </div>
</template>
