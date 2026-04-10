export default defineEventHandler((event) => {
  // дані тарифу
  return {
    planName: 'Team - Annual',
    price: 207.50,
    oldPrice: 2988,
    newPrice: 2490,
    savings: 498,
    features: [
      'Primary user + 2 free team members <br><span class="text-[10px] text-gray-500">(extra team members for $25/month)</span>',
      'Save unlimited properties',
      '<b>50,000</b> exports <br><span class="text-[10px] text-gray-500">(additional exports at $0.01 each)</span>',
      '<b>1,000</b> free skip traces <br><span class="text-[10px] text-gray-500">(additional skip tracing at $0.08 each)</span>',
      'Imports $0.01',
      '<b>FREE</b> daily product trainings and support',
      'Full suite of next-gen investing tools',
      'Industry first AI powered comp tool',
      'Includes dedicated support agent'
    ]
  }
})
