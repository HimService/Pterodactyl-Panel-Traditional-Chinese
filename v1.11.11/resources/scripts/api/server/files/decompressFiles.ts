import http from '@/api/http';

export default async (uuid: string, directory: string, file: string): Promise<void> => {
    await http.post(
        `/api/client/servers/${uuid}/files/decompress`,
        { root: directory, file },
        {
            timeout: 300000,
            timeoutErrorMessage:
                '這個壓縮檔似乎需要很長時間才能解壓縮。完成後，解壓縮的檔案將會出現在檔案列表中。',
        }
    );
};
