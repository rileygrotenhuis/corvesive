<script setup lang="ts">
import type { IAttachPayPeriodBudgetRequest } from '~/http/requests/budgets.request';
import type { IBudgetResource } from '~/http/resources/budgets.resource';

const accountStore = useAccountStore();
const budgetStore = useBudgetStore();
const modalStore = useModalStore();

await budgetStore.getBudgets(true);

const budgetOptions = computed(() => {
  return budgetStore.budgets.map((budget: IBudgetResource) => {
    return {
      label: `${budget.name} - ${budget.amount.pretty}`,
      value: budget.id,
    };
  });
});

const selectedBudget: Ref<number> = ref(0);

const form: IAttachPayPeriodBudgetRequest = reactive({
  total_balance: 0,
});

const errors = ref();

const handleSubmit = async () => {
  form.total_balance = form.total_balance * 100;

  const response = await useNuxtApp().$api.budgets.attachBudgetToPayPeriod(
    accountStore.user.pay_period.id,
    selectedBudget.value,
    form
  );

  if (!(errors.value = response.errors)) {
    modalStore.closePeriodModal();
    await budgetStore.getPayPeriodBudgets(
      accountStore.user.pay_period.id,
      true
    );
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">Attach Budget to Period</h4>
      <UFormGroup label="Select one of your recurring Budgets" name="budget_id">
        <USelect v-model="selectedBudget" :options="budgetOptions" />
      </UFormGroup>
      <UDivider />
      <p class="text-sm font-bold">Then fill in the relative details</p>
      <UFormGroup label="Total Balance" name="total_balance">
        <UInput v-model="form.total_balance" />
      </UFormGroup>
      <UButton type="submit" color="rose"> Attach </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
