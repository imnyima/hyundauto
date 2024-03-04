import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CocheListComponent } from './coche-list.component';

describe('CocheListComponent', () => {
  let component: CocheListComponent;
  let fixture: ComponentFixture<CocheListComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [CocheListComponent]
    });
    fixture = TestBed.createComponent(CocheListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
