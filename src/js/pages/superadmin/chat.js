document.addEventListener('DOMContentLoaded', () => {
  const userChat = document.querySelector('.user__chat');
  if (!userChat) return;

  userChat.addEventListener('click', (e) => {
    const _return = e.target.closest('.user__chat-text-return');
    if (!_return) return;

    const leftBlock = userChat.querySelector('.user__chat-left');
    const rightBlock = userChat.querySelector('.user__chat-right');

    const rightContent = userChat.querySelector('.user__chat-right-content');
    const rightBtn = userChat.querySelector('.user__chat-btn');

    rightBtn.classList.add('active');
    rightContent.classList.remove('active');
    leftBlock.classList.add('active');
    rightBlock.classList.remove('active');
  });

  const ticketsContainer = userChat.querySelector('.user__chat-tickets-items');
  ticketsContainer.addEventListener('click', (e) => {
    const ticketItem = e.target.closest('.user__chat-tickets-item');
    if (!ticketItem) return;

    // Снять .active со всех
    ticketsContainer
      .querySelectorAll('.user__chat-tickets-item')
      .forEach((item) => item.classList.remove('active'));
    // Повесить .active на текущий
    ticketItem.classList.add('active');

    ticketItem.dispatchEvent(
      new CustomEvent('selectTicket', {
        detail: {
          ticket: ticketItem,
        },
      })
    );

    const leftBlock = userChat.querySelector('.user__chat-left');
    const rightBlock = userChat.querySelector('.user__chat-right');

    const rightContent = userChat.querySelector('.user__chat-right-content');
    const rightBtn = userChat.querySelector('.user__chat-btn');

    rightBtn.classList.remove('active');
    rightContent.classList.add('active');
    leftBlock.classList.remove('active');
    rightBlock.classList.add('active');

    const chatMessages = document.getElementById('chat-messages');
    chatMessages.scrollTop = chatMessages.scrollHeight;
  });

  const filters = userChat.querySelector('.user__chat-filters');
  const filtersItems = filters.querySelectorAll('.user__chat-filter');
  filtersItems.forEach((filterItem) => {
    filterItem.addEventListener('click', () => {
      filtersItems.forEach((item) => {
        item.classList.remove('active');
      });
      filterItem.classList.add('active');

      filterItem.dispatchEvent(
        new CustomEvent('filterChat', {
          detail: {
            filter: filterItem,
          },
        })
      );
    });
  });
});
