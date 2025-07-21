<div class="modal active modal_notifications" onclick="document.querySelector('.modal_notifications').remove();document.body.style.overflow='';">
  <div class="modal__table" onclick="document.querySelector('.modal_notifications').remove();document.body.style.overflow='';">
    <div class="modal__ceil" onclick="document.querySelector('.modal_notifications').remove();document.body.style.overflow='';">
      <form class="modal__content" onclick="event.stopPropagation()">
        <div class="modal__close" onclick="document.querySelector('.modal_notifications').remove();document.body.style.overflow='';">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.27632 0.374724L7.63348 5.73188L12.9629 0.402481C13.0806 0.277181 13.2224 0.176945 13.3798 0.107785C13.5372 0.0386241 13.707 0.00196292 13.8789 0C14.247 0 14.6 0.146221 14.8602 0.406496C15.1205 0.666772 15.2667 1.01978 15.2667 1.38787C15.27 1.55802 15.2384 1.72704 15.174 1.88456C15.1095 2.04207 15.0136 2.18476 14.892 2.30386L9.49323 7.63326L14.892 13.0321C15.1208 13.2558 15.2549 13.5589 15.2667 13.8787C15.2667 14.2467 15.1205 14.5997 14.8602 14.86C14.6 15.1203 14.247 15.2665 13.8789 15.2665C13.702 15.2739 13.5255 15.2443 13.3607 15.1798C13.1958 15.1153 13.0462 15.0172 12.9213 14.8918L7.63348 9.53463L2.2902 14.8779C2.17294 14.999 2.03284 15.0957 1.87801 15.1624C1.72318 15.2291 1.55667 15.2645 1.38809 15.2665C1.02001 15.2665 0.666997 15.1203 0.406722 14.86C0.146447 14.5997 0.000225815 14.2467 0.000225815 13.8787C-0.00300999 13.7085 0.0285597 13.5395 0.0929976 13.382C0.157436 13.2244 0.253382 13.0818 0.374949 12.9627L5.77375 7.63326L0.374949 2.23446C0.146208 2.01068 0.0120777 1.70765 0.000225815 1.38787C0.000225815 1.01978 0.146447 0.666772 0.406722 0.406496C0.666997 0.146221 1.02001 0 1.38809 0C1.72118 0.0041636 2.04039 0.138786 2.27632 0.374724Z" fill="#999999"></path>
          </svg>
        </div>
        <div class="modal__title modal__title_center">description field</div>
        <div class="user__input-el">
          <textarea name="description" placeholder="default"></textarea>
        </div>
        <button class="p-btn p-btn_orange p-btn_center modal_notifications__btn" type="submit">Save</button>
      </form>
    </div>
  </div>
</div>
