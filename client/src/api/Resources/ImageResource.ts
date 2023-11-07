import { AbstractResource } from '../AbstractResource';

import type { ImageDetailsResponse } from '../Response/ImageDetailsResponse';

import type { UploadedImageResponse } from '../Response/UploadedImageResponse';

export class ImageResource extends AbstractResource {
  public async upload(image: File): Promise<UploadedImageResponse> {
    const body = new FormData();
    body.append('image', image);

    return this.post('/upload', { body });
  }

  public async getDetails(id: string): Promise<ImageDetailsResponse> {
    return this.get(`/image/${id}/detail`);
  }
}